<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //

    public function getLogin()
    {
        return view('auth.login');
    }
    public function postLogin(LoginRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        // $data = $request->except('_token'); // lấy ra tất cả trong mảng loại thằng token ra
        if (Auth::attempt([
            'email' => $email, // trường thông tin email trong DB
            'password' => $password
        ])) {
            return redirect()->route('users.list');
        } else {
            return redirect()->route('auth.getLogin');
        };
    }

    public function logout(Request $request)
    {
        // xóa session user đã đăng nhập
        Auth::logout();
        // Hủy toàn bộ session đi
        $request->session()->invalidate();
        // Tạo token mới
        $request->session()->regenerateToken();
        // quay về mh chịn
        return redirect()->route('auth.getlogin');
    }
    public function getRegister()
    {
        return view('auth.register');
    }
    public function postRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $data['role'] = 0;
        $data['status'] = 0;
        $data['avatar'] = 'images/users/user.png';
        $data['password'] = Hash::make($request['password']);
        User::create($data);
        return redirect()->route('auth.getlogin');
    }

    public function getGoogleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googleLoginCallback()
    {
        $googleUser = Socialite::driver('google');
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('users.list');
        } else {
            // 'name',
            // 'email',
            // 'password',
            // 'avatar',
            // 'username',
            // 'status',
            // 'role',
            // 'code'

            $newUser = new User();
            $newUser->fill($googleUser);
            $newUser->role = config('roles.ADMIN');
            $newUser->status = config('status.ACTIVE');
            $newUser->code = '';
            $newUser->username = '';
            $newUser->password = '';
            $newUser->save();
            Auth::login($newUser); // đăng nhập trước rồi đổi password

            return redirect()->route('auth.create-password');

        }
    }
}
