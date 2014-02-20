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
            $tweets = Auth::user()->tweets();
        } else {
            $tweets = Tweet::with('replies')->whereIn('author_id', $foll_ids);
        }
        /* Костыль */
        $retweets = Auth::user()->retweets;
        foreach($retweets as $tw) {
            $tw->id = $tw->id*(-1);
            $tw->created_at = $tw->pivot->created_at;
        }
        $tweets = $retweets->merge(Auth::user()->tweets)->sortBy(function($tweet){
            return $tweet->created_at;
        })->reverse();
        return $tweets->slice(0, 30);
    }
}
