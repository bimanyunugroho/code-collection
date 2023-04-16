<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function formRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'string|required|max:255',
            'last_name' => 'string|required|max:255',
            'username' => 'string|required|max:255|unique:users',
            'email' => 'string|required|max:255|unique:users',
            'password' => 'string|required|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            Alert::error('error', implode('<br>', $validator->errors()->all()));
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            try {
                $user->save();
                Alert::success('success', 'Selamat anda berhasil terdaftarkan!');
                $redirect = redirect()->route('login.index');
            } catch (\Throwable $th) {
                Alert::error('error', 'Oopss!' . $th->getMessage());
                $redirect = redirect()->back();
            }

            return $redirect;
        }

    }


    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request) {

        $credentials = $request->only([$this->username(), 'password']);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            Alert::success('success', 'Selamat anda berhasil masuk!');
            return redirect()->intended('/home');
        } else {
            Alert::error('error', 'Email/username dan password salah!');
            return redirect()->back();
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        Alert::success('success', 'Anda berhasil keluar.');
        return redirect()->route('login.index');
    }

    public function username()
    {
        $login = request()->input('username');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

}
