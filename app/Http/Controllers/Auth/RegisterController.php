<?php
declare(strict_types=1);

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
    /**
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
     */
    public function showRegistrationForm(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('auth.register');
    }

    // Обработка данных формы регистрации

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function register(Request $request): \Illuminate\Http\RedirectResponse
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

    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Validation\Validator
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    // Метод для создания нового пользователя

    /**
     * @param array $data
     * @return mixed
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}

