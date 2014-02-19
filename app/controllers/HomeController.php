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
    
    private function get_tweets() {
        $foll_ids = array(Auth::user()->id);
        foreach(Auth::user()->following as $foll_user) {
            $foll_ids[] = $foll_user->id;
        }
        if(count($foll_ids) == 1) {
            return Auth::user()->tweets;
        } else {
            return Tweet::with('replies')->whereIn('author_id', $foll_ids)->orderBy('created_at', 'desc')->limit(30)->get();
        }
    }
}
