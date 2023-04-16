<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
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

    public function formProfile($id)
    {
        $data = [
            'title' => 'Setting Profile User',
            'desc' => 'Halo, ' . auth()->user()->username,
            'users' => User::findOrFail($id)
        ];

        return view('auth.user.setting', $data);
    }

    public function profile(Request $request, $id)
    {
        $request->validate([
            'first_name' => [$this->isUpdate(), 'string', 'max:255'],
            'last_name' => [$this->isUpdate(), 'string', 'max:255'],
            'username' => [$this->isUpdate(), 'string', 'max:255', Rule::unique('users')->ignore($id)],
            'email' => [$this->isUpdate(), 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);

        $user = User::findOrFail($id);
        $updateUser = $user->update($request->only(['first_name', 'last_name', 'username', 'email']));

        if ($updateUser) {
            Alert::success('success', 'Selamat, Profile ada berhasil diperbaharui!');
            $redirect = redirect()->back();
        } else {
            Alert::error('error', 'Sepertinya ada yang salah!');
            $redirect = redirect()->back();
        }

        return $redirect;
    }


    public function isUpdate()
    {
        return request()->isMethod('POST') ? 'required' : 'sometimes';
    }
}
