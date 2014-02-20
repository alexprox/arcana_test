<?php

class SparrowController extends BaseController {

    public static function get_tweets($user, $with_followers = true) {
        $foll_ids = array($user->id);
        if($with_followers) {
            foreach($user->following as $foll_user) {
                $foll_ids[] = $foll_user->id;
            }
        }
        $tweets = Tweet::with('replies')
                ->with('author')
                ->with('retweet')
                ->whereIn('author_id', $foll_ids)
                ->orderBy('created_at','desc')
                ->limit(30)
                ->get();
        return $tweets;
    }
    
    public function writeTweet() {
        if(Auth::check()) {
            $data = Input::all();
            $validator = Validator::make(
                $data,
                array(
                    'tweet' => 'required|between:3,140'
                )
            );
            if($validator->fails()) {
                return Response::json(array('err' => $validator->messages()->first()));
            } else {
                return Response::json(array('tweeted' => $this->tweet($data['tweet'])));
            }
        }
        return Response::json(array('err' => 'You can\'t do this'));
    }
    
    public function replyTweet() {
        if(Auth::check()) {
            $data = Input::all();
            $validator = Validator::make(
                $data,
                array(
                    'tweet' => 'required|between:3,140',
                    'tweet_id' => 'required',
                )
            );
            if($validator->fails()) {
                return Response::json(array('err' => $validator->messages()->first()));
            } else {
                return Response::json(array('tweeted' => $this->tweet($data['tweet'], $data['tweet_id'])));
            }
        }
        return Response::json(array('err' => 'You can\'t do this'));
    }
    
    public function retweet() {
        if(Auth::check()) {
            $tweet = new Tweet;
            $tweet->author_id = Auth::user()->id;
            $tweet->retweet_id = Input::get('tweet_id');
            return Response::json(array('tweeted' => $tweet->save()));
        }
        return Response::json(array('err' => 'You can\'t do this'));
    }
    
    private function tweet($text, $reply_to_id = false) {
        $tweet = new Tweet;
        $tweet->text = trim($text);
        $tweet->author_id = Auth::user()->id;
         if ($reply_to_id) {
            $tweet->tweet_id = $reply_to_id;
        }
        return $tweet->save();
    }
}
