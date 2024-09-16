<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Форма для авторизации
    public function showLoginForm(){
        return view('login.login');
    }

        // Метод для входа в аккаунт
    public function login(Request $request){

            // Валидация данных
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
    
            // Попытка аутентификации пользователя
            if (Auth::attempt($request->only('email', 'password'))) {
                // Если успешная аутентификация, перенаправляем пользователя
                return redirect()->intended('/home');
            }
    
            // Если авторизация не удалась, вернуть ошибку
            throw ValidationException::withMessages([
                'email' => 'Неверный email или пароль.',
            ]);
    }
        
    // Метод для выхода из аккаунта
    public function logout(Request $request)
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
    
            return redirect()->route('register')
            ->with('success', 'Вы усмпешно вышли из аккаунта');
        }
}
