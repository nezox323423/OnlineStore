<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  
    // Показываем форму регистрации
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Обработка данных формы регистрации
    public function register(Request $request)
    {
        // Валидация данных
        $this->validator($request->all())->validate();

        // Создание пользователя
        $user = $this->create($request->all());

        // Аутентификация пользователя после регистрации
        auth()->login($user);

        // Перенаправление на главную страницу
        return redirect()->route('home')->with('success', 'Регистрация прошла успешно');
    }

    // Метод валидации данных
    protected function validator(array $data)
    {
    
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Метод для создания нового пользователя
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
       
}

