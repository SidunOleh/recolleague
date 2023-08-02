<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | REC</title>

</head>
<body>
    <div class="logo" style="margin-bottom: 20px;">
        <img src="{{ $message->embed(public_path('/assets/img/Logo.png')) }}">
    </div>
    <div class="text">
        @yield('text')
    </div>
</body>
</html>