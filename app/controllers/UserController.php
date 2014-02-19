<?php

class UserController extends BaseController {

    public function signIn() {
       $data = Input::all();
        $validator = Validator::make(
            $data,
            array(
                'username' => 'required|regex:/\w+/|between:3,32',
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
                'username' => 'required|regex:/\w+/|between:3,32',
                'password' => 'required|min:8',
                'fullname' => 'required|regex:/[a-zA-Z]+\s+[a-zA-Z]+/|between:3,64'
            )
        );
        if($validator->fails()) {
            return Response::json(array('err' => $validator->messages()->first()));
        } else {
            $user = new User;
            $user->username = mb_strtolower($data['username']);
            $user->pass = Hash::make($data['password']);
            $user->fullname = $data['fullname'];
            return Response::json(array('msg' => $user->save()?'Success':'Fail, don\'t know why'));
        }
    }
    
    public function signOut() {
        if(Auth::check()) {
            Auth::logout();
        }
        return Redirect::to(URL::route('home'));
    }
    
    public function findUser($username) {
        
        $user = User::with('followers')->with('following')->with('tweets')->where('username', '=', mb_strtolower($username))->first();
        if($user) {
            $this->layout->content = View::make('User/info', array(
                'user_info' => $user
            ));
        } else {
            $this->layout->content = View::make('User/not_found', array(
                'username' => $username
            ));
        }
    }
        

}
