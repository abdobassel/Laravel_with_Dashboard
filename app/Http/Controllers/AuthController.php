<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as ValidationValidator;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),

        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    //logout 

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        return redirect('/');
    }


    //profile 

    public function profile(Request $request)
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // قواعد الصورة المسموح بها
        ]);
        $user =  User::find($request->userid);
        $user->name = $request->name;
        $user->email = $request->email;
        // Check if password field is not empty
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user) {
            // تحميل الصورة إذا تم تحميلها
            if ($request->hasFile('profile_img')) {
                $profilePicture = $request->file('profile_img');
                $fileName = time() . '_' . $profilePicture->getClientOriginalName();
                // اختر المسار المناسب لتخزين الصورة، هنا سنختار مجلد public
                $filePath = 'uploads/profile_pictures/';
                $profilePicture->move(public_path($filePath), $fileName);
                // حفظ اسم الصورة في قاعدة البيانات
                $user->profile_picture = $filePath . $fileName;
            }

            $user->save();
        }


        return redirect()->route('profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
