<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php /*
    {{ date('Y') }}
    <br />
    {{ 3 + 7 }}
    <br />
    {!! "<h3>Hello</h3>" !!}
    <?= "<h3>Hello</h3>" ?>
    <h2>
         Hello @{{ name }} {{-- Ao adicionar o @, o blade não faz o render, permitindo o JavaScript fazer. --}}
    </h2>

    @php
        $message = "Hello World";
    @endphp

    <h2>{{ $message }}</h2>
    */ ?>

    <h1>Contact App</h1>
    <div>
        <a href=' {{ route('contacts.index') }}'>All Contacts</a>
    </div>
</body>
</html>