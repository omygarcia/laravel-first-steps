<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if (auth()->check())
        <script>
            window.laravel = {!!
                    json_encode([
                        'isloggedin'=>true,
                        'user'=>auth()->user(),
                        'token'=>session('token')
                    ])
                !!}
        </script>
    @endif
    <div class="container">
        <div id="app"></div>
    </div>
    @vite('resources/js/vue/main.js')
</body>
</html>