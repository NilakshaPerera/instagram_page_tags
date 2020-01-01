<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class HomeControler extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('welcome');
    }


   /**
     * Created by : Nilaksha 
     * Cteated At :  13/12/2019
     * Summary :  Saves the contact information
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:contacts',
            'email' => 'required|unique:contacts',
            'contact_no' => 'required'
        ],[
            'username.unique' => 'This username is already used',
            'email.unique' => 'This email is already used',
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'messagef' => $validator->errors()->all()[0]]);
        }

        return response()->json(['success' => true, 'message' => 'Your submission was a success.']);
    }

}
