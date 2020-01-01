<?php

namespace App\Http\Controllers\user;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Libraries\LogData;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function changePasswordForm() {
        return view('auth.changepassword');
    }

    /**
     * Created By : Nilaksha 
     * Created At : 26-11-2019
     * Summary : Resets the password
     * 
     * @param Request $request
     * @return type
     */
    public function changePassword(Request $request) {

        try {
            if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {

                return redirect()->back()->with("error", "Your current password does not match with the password you provided. Please try again. ");
            }
            if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
                //Current password and new password are same
                return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
            }

            $validator = Validator::make($request->all(), [
                        'current-password' => 'required',
                        'new-password' => 'required|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with("error", "Make sure the new password has more than 6 charactors.");
            }

            //Change Password
            $user = Auth::user();
            $user->password = bcrypt($request->get('new-password'));
            $user->save();
            return redirect()->back()->with("success", "Password changed successfully !");
        } catch (Exception $ex) {
            return redirect()->back()->with("error", "An unexpected error has occured.");
        }
    }

}
