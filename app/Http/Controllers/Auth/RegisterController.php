<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // ✅ 自動で会員番号を発番（例：M000001）
        $latestId = User::max('id') ?? 0;
        $memberNumber = 'M' . str_pad($latestId + 1, 6, '0', STR_PAD_LEFT);

        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'member_number' => $memberNumber,
        ]);

       

        Auth::login($user);

        return redirect()->route('home')->with('success', '新規登録が完了しました');
    }
}

?>
