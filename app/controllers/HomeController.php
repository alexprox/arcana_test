<?php

class HomeController extends BaseController {

    public function showHomePage() {
        if(!Auth::check()) {
            $this->layout->content = View::make('Home/home');
        } else {
            $this->layout->content = View::make('Home/feed', array(
                'tweets' => $this->get_tweets()
            ));
        }
    }
    
    public function getTweets() {
        $tweets = array();
        if(Auth::check()) {
            $tweets = $this->get_tweets();
        }
        return Response::json(array('tweets' => $tweets));
    }
    
    private function get_tweets() {
        $foll_ids = array(Auth::user()->id);
        foreach(Auth::user()->following()->get() as $foll_user) {
            $foll_ids[] = $foll_user->id;
        }
        return Tweet::whereIn('author_id', $foll_ids)->orderBy('created_at')->get();
    }
}
