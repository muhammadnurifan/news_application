<?php

namespace App\Http\Controllers;

use App\Repositories\user\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;    
    }

    public function form_register()
    {
        return view('login.register');
    }

    public function form_login()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {
        $validate = $request->validate([
            'email'    => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($validate)) {
            return redirect()->intended('/news');
        }

        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }

    public function store(Request $request)
    {
        $user = $this->user->store($request);

        if (empty($user)) {
            return view('login.register')->with('error', 'error, please try again');
        }

        return redirect('/')->with('sukses','Data Inputted Successfully');
    }

    // API
    public function authenticate_api(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6'
        ]);
    
        //KITA CARI USER BERDASARKAN EMAIL
        $user = User::where('email', $request->email)->first();
        //JIK DATA USER ADA
        //KITA CHECK PASSWORD USER APAKAH SUDAH SESUAI ATAU BELUM
        //UNTUK MEMBANDINGKAN ENCRYPTED PASSWORD DENGAN PLAIN TEXT, KITA BISA MENGGUNAKAN FACADE CHECK
        if ($user && Hash::check($request->password, $user->password)) {
            $token = Str::random(40); //GENERATE TOKEN BARU
            $user->update(['api_token' => $token]); //UPDATE USER TERKAIT
            //DAN KEMBALIKAN TOKENNYA UNTUK DIGUNAKAN PADA CLIENT
            return response()->json(['status' => 'success', 'data' => $token]);
        }
        //JIKA TIDAK SESUAI, BERIKAN RESPONSE ERROR
        return response()->json(['status' => 'error']);
    }

    public function register(Request $request)
    {
        $user = $this->user->store($request);

        if (empty($user)) {
            return view('login.register')->with('error', 'error, please try again');
        }

        return response()->json($user);
    }
}
