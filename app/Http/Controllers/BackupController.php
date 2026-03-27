<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Process\Process;
use ZipArchive;

class BackupController extends Controller
{
    public function index(): View
    {
        $backupDir = storage_path('app/backups');
        File::ensureDirectoryExists($backupDir);

        $backups = collect(File::files($backupDir))
            ->filter(fn ($file) => strtolower($file->getExtension()) === 'zip')
            ->map(function ($file) {
                return [
                    'filename' => $file->getFilename(),
                    'size' => $this->formatBytes($file->getSize()),
                    'last_modified' => date('d-m-Y H:i:s', $file->getMTime()),
                ];
            })
            ->sortByDesc('last_modified')
            ->values();

        return view('backup.index', compact('backups'));
    }

    public function store(): RedirectResponse
    {
        $timestamp = now()->format('Ymd_His');
        $backupDir = storage_path('app/backups');
        $tempDir = storage_path('app/temp-backups/' . $timestamp);
        $zipPath = $backupDir . '/backup_' . $timestamp . '.zip';
        $sqlPath = $tempDir . '/database.sql';

        File::ensureDirectoryExists($backupDir);
        File::ensureDirectoryExists($tempDir);

        try {
            $this->dumpDatabase($sqlPath);

            $zip = new ZipArchive();

            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                throw new \RuntimeException('Gagal membuat file ZIP backup.');
            }

            if (File::exists($sqlPath)) {
                $zip->addFile($sqlPath, 'database/database.sql');
            }

            $this->addDirectoryToZip(
                storage_path('app/public/employees/photos'),
                $zip,
                'files/employees/photos'
            );

            $this->addDirectoryToZip(
                storage_path('app/employees/documents'),
                $zip,
                'files/employees/documents'
            );

            $this->addDirectoryToZip(
                storage_path('app/public/users/photos'),
                $zip,
                'files/users/photos'
            );

            $zip->close();

            File::deleteDirectory($tempDir);

            return redirect()
                ->route('backup.index')
                ->with('success', __('Backup created successfully.'));
        } catch (\Throwable $e) {
            File::deleteDirectory($tempDir);

            return redirect()
                ->route('backup.index')
                ->with('backup_error', __('Backup failed to create.') . ': ' . $e->getMessage());
        }
    }

    public function download(string $filename): BinaryFileResponse
    {
        if (str_contains($filename, '..') || str_contains($filename, '/') || str_contains($filename, '\\')) {
            abort(404);
        }

        $path = storage_path('app/backups/' . $filename);

        abort_unless(File::exists($path), 404);

        return response()->download($path);
    }

    private function dumpDatabase(string $sqlPath): void
    {
        $connection = config('database.default');
        $db = config("database.connections.{$connection}");

        if (($db['driver'] ?? null) !== 'mysql') {
            throw new \RuntimeException('Saat ini backup otomatis hanya disiapkan untuk MySQL.');
        }

        $mysqldump = env('MYSQLDUMP_PATH', 'C:/xampp/mysql/bin/mysqldump.exe');

        if (!File::exists($mysqldump)) {
            throw new \RuntimeException('File mysqldump tidak ditemukan di path: ' . $mysqldump);
        }

        $username = (string) ($db['username'] ?? '');
        $password = (string) ($db['password'] ?? '');
        $host = (string) ($db['host'] ?? '127.0.0.1');
        $port = (string) ($db['port'] ?? '3306');
        $database = (string) ($db['database'] ?? '');

        if ($database === '') {
            throw new \RuntimeException('Nama database kosong. Periksa konfigurasi DB_DATABASE di file .env.');
        }

        $command = [
            $mysqldump,
            '--host=' . $host,
            '--port=' . $port,
            '--user=' . $username,
            '--default-character-set=utf8mb4',
            '--skip-lock-tables',
            '--result-file=' . $sqlPath,
            $database,
        ];

        if ($password !== '') {
            $command[] = '--password=' . $password;
        }

        $env = array_merge($_ENV, $_SERVER, [
            'SystemRoot' => $_SERVER['SystemRoot'] ?? getenv('SystemRoot') ?: 'C:\\Windows',
            'WINDIR' => $_SERVER['WINDIR'] ?? getenv('WINDIR') ?: 'C:\\Windows',
            'ComSpec' => $_SERVER['ComSpec'] ?? getenv('ComSpec') ?: 'C:\\Windows\\System32\\cmd.exe',
            'PATH' => getenv('PATH') ?: '',
        ]);

        $process = new Process($command, null, $env);
        $process->setTimeout(300);
        $process->run();

        if (!$process->isSuccessful()) {
            $errorText = trim($process->getErrorOutput() . ' ' . $process->getOutput());

            throw new \RuntimeException(
                $errorText !== '' ? $errorText : 'mysqldump gagal dijalankan.'
            );
        }

        if (!File::exists($sqlPath) || filesize($sqlPath) === 0) {
            throw new \RuntimeException('File SQL backup tidak berhasil dibuat.');
        }
    }

    private function addDirectoryToZip(string $sourcePath, ZipArchive $zip, string $zipBasePath): void
    {
        if (!File::exists($sourcePath)) {
            return;
        }

        $items = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($sourcePath, \FilesystemIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );

        foreach ($items as $item) {
            $realPath = $item->getRealPath();

            if (!$realPath) {
                continue;
            }

            $relativePath = ltrim(str_replace($sourcePath, '', $realPath), DIRECTORY_SEPARATOR);
            $relativePath = str_replace(DIRECTORY_SEPARATOR, '/', $relativePath);
            $zipEntry = trim($zipBasePath . '/' . $relativePath, '/');

            if ($item->isDir()) {
                $zip->addEmptyDir($zipEntry);
            } else {
                $zip->addFile($realPath, $zipEntry);
            }
        }
    }

    private function formatBytes(int $bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        }

        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        }

        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        }

        return $bytes . ' B';
    }
}