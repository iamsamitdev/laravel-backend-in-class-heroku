<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" crossorigin="anonymous" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Livewire</title>
    @livewireStyles
</head>
<body>
    
    {{-- @livewire('counter') --}}
    {{-- <livewire:counter />  --}}

    <div class="w-7/12 mt-10 mx-auto rounded p-2">
        {{-- <livewire:comments cmd="I am props comming from welcome page" /> --}}
        {{-- <livewire:comments :initialComments="$comments" /> --}}
        <livewire:comments />
    </div>

    @livewireScripts
</body>
</html>