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
    
    private function tweet($text, $reply_to_id = false) {
        $tweet = new Tweet;
        $tweet->text = trim($text);
        $tweet->author_id = Auth::user()->id;
         if ($reply_to_id) {
            $tweet->reply_to = $reply_to_id;
        }
        return $tweet->save();
    }
}
