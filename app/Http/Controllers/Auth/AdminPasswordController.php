<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AdminPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('admin.admin-forgot-password'); // This must match your view name
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('admins')->sendResetLink(
            $request->only('email')
        );

        return back()->with('status', __($status));
    }
}
