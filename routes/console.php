<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;
use Symfony\Component\Process\Process;

Artisan::command('inspire', function () {
    $this->comment('Stay focused.');
})->purpose('Display an inspiring quote');

Artisan::command('backup:monthly', function () {
    $timestamp = now()->format('Ymd_His');
    $backupDir = storage_path('app/backups');
    $tempDir = storage_path('app/temp-backups/' . $timestamp);
    $zipPath = $backupDir . '/backup_' . $timestamp . '.zip';
    $sqlPath = $tempDir . '/database.sql';

    File::ensureDirectoryExists($backupDir);
    File::ensureDirectoryExists($tempDir);

    $dumpDatabase = function (string $sqlPath): void {
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

        if (! $process->isSuccessful()) {
            $errorText = trim($process->getErrorOutput() . ' ' . $process->getOutput());

            throw new \RuntimeException(
                $errorText !== '' ? $errorText : 'mysqldump gagal dijalankan.'
            );
        }

        if (!File::exists($sqlPath) || filesize($sqlPath) === 0) {
            throw new \RuntimeException('File SQL backup tidak berhasil dibuat.');
        }
    };

    $addDirectoryToZip = function (string $sourcePath, \ZipArchive $zip, string $zipBasePath): void {
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
    };

    try {
        $dumpDatabase($sqlPath);

        $zip = new \ZipArchive();

        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
            throw new \RuntimeException('Gagal membuat file ZIP backup.');
        }

        if (File::exists($sqlPath)) {
            $zip->addFile($sqlPath, 'database/database.sql');
        }

        $addDirectoryToZip(
            storage_path('app/public/employees/photos'),
            $zip,
            'files/employees/photos'
        );

        $addDirectoryToZip(
            storage_path('app/employees/documents'),
            $zip,
            'files/employees/documents'
        );

        $addDirectoryToZip(
            storage_path('app/public/users/photos'),
            $zip,
            'files/users/photos'
        );

        $zip->close();

        File::deleteDirectory($tempDir);

        $this->info('Backup bulanan berhasil dibuat: ' . basename($zipPath));

        return 0;
    } catch (\Throwable $e) {
        File::deleteDirectory($tempDir);

        report($e);
        $this->error('Backup bulanan gagal: ' . $e->getMessage());

        return 1;
    }
})->purpose('Membuat backup database dan file setiap bulan');

Schedule::command('backup:monthly')
    ->monthlyOn(1, '01:00')
    ->withoutOverlapping();

Schedule::command('contracts:check-expiring')
    ->dailyAt('08:00')
    ->withoutOverlapping();