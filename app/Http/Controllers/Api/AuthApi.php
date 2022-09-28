<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApi extends Controller
{
    public function changePassword(Request $request)
    {
        $current = $request->currentPassword;
        $new = $request->newPassword;

        //check db hash
        $user_id = auth()->id();
        $hashedPassword = User::where('id', $user_id)->first()->password;
        $checkPassword  =  Hash::check($current, $hashedPassword);

        //new password  database hashed


        if ($current === $new) {
            return 'you_already';
        }

        if ($checkPassword) {
            $newPassword = Hash::make($new);
            User::where('id', $user_id)->update([
                'password' => $newPassword
            ]);
            return 'success';
        }
        return 'wrong_password';
    }
}
