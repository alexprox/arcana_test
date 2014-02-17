<?php

class UserController extends BaseController {

    public function signIn() {
        $validator = Validator::make(
            Input::all(),
            array(
                'username' => 'required|min:3',//|unique:users
                'password' => 'required|min:8'
            )
        );
        return Response::json(array('signUp' => !$validator->fails()));
    }
    
    public function signUp() {
        $validator = Validator::make(
            Input::all(),
            array(
                'username' => 'required|min:3',//|unique:users
                'password' => 'required|min:8',
                'fullname' => 'required'
            )
        );
        return Response::json(array('signUp' => !$validator->fails()));
    }

}
