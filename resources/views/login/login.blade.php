<!DOCTYPE html>
<html lang="en">
<head>
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <style></style>
</head>
<body>
       <!-- Сообщение об ошибке -->
       @if ($errors->any())
       <div style="color: red;">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
   @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>

        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit">Войти</button>
    </form>
</body>
</html>