<?php

class HomeController extends BaseController {

    public function showHomePage() {
        if(!Auth::check()) {
            $this->layout->content = View::make('Home/home');
        } else {
            $this->layout->content = View::make('Home/feed', array(
                'tweets' => SparrowController::get_tweets(Auth::user())
            ));
        }
    }
}
