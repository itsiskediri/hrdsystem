<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="csrf-token" content="{{ csrf_token() }}" />

<title>
    {{ filled($title ?? null) ? $title.' - '.config('app.name', 'HRD Surya Inspirasi Schools') : config('app.name', 'HRD Surya Inspirasi Schools') }}
</title>

<link rel="icon" type="image/x-icon" href="{{ asset('sispng.ico') }}">
<link rel="shortcut icon" href="{{ asset('sispng.ico') }}">
<link rel="apple-touch-icon" href="{{ asset('images/sispng.png') }}">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance