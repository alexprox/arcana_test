<?php

class SparrowController extends BaseController {

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
            $retweet = new Retweet;
            $retweet->tweet_id = Input::get('tweet_id');
            $retweet->retweeter_id = Auth::user()->id;
            return Response::json(array('tweeted' => $retweet->save()));
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
