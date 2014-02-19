<?php

class UserController extends BaseController {

    public function signIn() {
       $data = Input::all();
        $validator = Validator::make(
            $data,
            array(
                'username' => 'required|alpha_dash|between:3,32',
                'password' => 'required|min:8'
            )
        );
        if($validator->fails()) {
            return Response::json(array('err' => $validator->messages()->first()));
        } else {
            if(Auth::attempt(array('username' => $data['username'], 'password' => $data['password']))) {
                return Response::json(array('redirect' => '/'));
            }
            return Response::json(array('err' => 'User not found'));
        }
    }
    
    public function signUp() {
        $data = Input::all();
        $validator = Validator::make(
            $data,
            array(
                'password' => 'required|min:8',
                'fullname' => 'required|regex:/\w+/|between:3,64'
            )
        );
        if($validator->fails()) {
            return Response::json(array('err' => $validator->messages()->first()));
        } else {
            $salt = md5(rand());
            $user = new User;
            $user->username = $data['username'];
            $user->pass = Hash::make($data['password']);
            $user->fullname = $data['fullname'];
            return Response::json(array('msg' => $user->save()?'Success':'Fail, don\'t know why'));
        }
    }

}
