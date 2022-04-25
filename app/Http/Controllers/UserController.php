<?php

namespace App\Http\Controllers;

use App\Models\User_account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    function getData()
    {
        return User_account::all();
    }

    public function signin(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "user_id" => "required",
                "password" => "required",
                "user_role" => "required"
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => 'All fields are required']);
        }

        $email_status = User_account::where("user_id", $request->user_id)->first();

        if (!is_null($email_status)) {
            $password_status = User_account::where("user_id", $request->user_id)->where("pwd", $request->password)->first();

            if (!is_null($password_status)) {
                $user = $this->userDetail($request->user_id);

                return response()->json(['status' => 200, 'message' => "You have logged in successfully", "id" => $user->user_id, "fname" => $user->fname, "lname" => $user->lname, "user_role" => $user->user_role]);
            } else {
                return response()->json(['status' => 500, 'message' => 'Unable to login. Incorrect password.']);
            }
        } else {
            return response()->json(['status' => 500, 'message' => 'Unable to login. Email does not exist']);
        }
    }

    public function userDetail($user_id)
    {
        $user = array();
        if ($user_id != "") {
            $user = User_account::where("user_id", $user_id)->first();
            return $user;
        }
    }

    public function register(Request $req)
    {
        $fields = Validator::make($req->all(), [
            'user_id' => 'required',
            'email_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'birth_place' => 'required',
            'dob' => 'required',
            'address' => 'required',
            'apt_no' => 'required',
            'pwd' => 'required',
            'proof_url' => 'required',
            'user_role' => 'required',
        ]);

        $lenght = Validator::make($req->all(), [
            'fname' => 'max:50',
            'lname' => 'max:50',
        ]);

        $pass = Validator::make($req->all(), [
            'pwd' => 'max:50',
        ]);

        $email = Validator::make($req->all(), [
            'email_id' => 'email'
        ]);

        if ($fields->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'All fields are required'
            ]);
        } else if ($lenght->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'First Name and Last Name max length is 50 characters. Please Check Your Input'
            ]);
        } else if ($pass->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Password max length is 50 characters. Please Check Your Input'
            ]);
        } else if ($email->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'The email must be a valid email address',
                'errors' => $email->messages(),
            ]);
        } else {
            $user_status = User_account::where("user_id", $req->user_id)->first();
            if (is_null($user_status)) {
                $user = new User_account;
                $user->user_id = $req->input('user_id');
                $user->email = $req->input('email_id');
                $user->fname = $req->input('fname');
                $user->lname = $req->input('lname');
                $user->birth_place = $req->input('birth_place');
                $user->dob = $req->input('dob');
                $user->address = $req->input('address');
                $user->apt_no = $req->input('apt_no');
                $user->pwd = $req->input('pwd');
                $user->proof_url = $req->input('proof_url');
                $user->user_role = $req->input('user_role');
                $user->save();
                return response()->json([
                    'status' => 200,
                    'message' => 'User Created Successfully',
                ]);
            } else {
                return response()->json([
                    'status' => 422,
                    'message' => 'User Already Exists',
                ]);
            }
        }
    }

    public function approveUser(Request $req)
    {
        try {
            $user = $this->userDetail($req->user_id);
            $user->is_active = "1";
            $user->update($req->all());
            return response()->json([
                'status' => 200,
                'message' => 'user Updated Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => 'Error has occured'
            ]);
        }

    }

    public function getUserDetails(Request $req)
    {
        $user = $this->userDetail($req->user_id);
        return response()->json([
            'status' => 200,
            'message' => $user,
        ]);
    }
}

