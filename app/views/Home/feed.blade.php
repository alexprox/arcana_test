@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 row">
        <div class="col-md-4">
            <div class="panel panel-default profile">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">{{ Auth::user()->fullname }}</h3>
                    {{ "@".Auth::user()->username }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => Auth::user()->username,
                                'count' => Auth::user()->tweets->count(),
                                'text' => 'Tweets'
                            )) }}
                        </div>
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => Auth::user()->username,
                                'count' => Auth::user()->following->count(),
                                'text' => 'Following'
                            )) }}
                        </div>
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => Auth::user()->username,
                                'count' => Auth::user()->followers->count(),
                                'text' => 'Followers'
                            )) }}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ Form::open(array('route' => 'writeTweet', 'class' => 'form-horizontal-no-label')) }}
                        {{ Form::textarea('tweet', NULL, array("class"=>"form-control", "placeholder"=>"Write tweet", "rows" => 1)) }}
                        <span class="counter badge pull-left" for="tweet" max="140">140</span>
                        {{ Form::submit('Tweet', array("class"=>"btn btn-primary btn-sm pull-right ajax")) }}
                        <div class="clearfix"></div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Tweets</h3>
                </div>
                <ul class="list-group tweets">
                    @foreach ($tweets as $tweet)
                        {{ View::make('tweet_each', array(
                            'username' => $tweet->author->username,
                            'fullname' => $tweet->author->fullname,
                            'date' => $tweet->created_at,
                            'text' => $tweet->text,
                            'id' => $tweet->id<0?$tweet->id*(-1):$tweet->id,
                            'reply_button' => Auth::user()->id != $tweet->author_id,
                            'retweet_button' => true,
                            'retweeted' => $tweet->id<0
                        )) }}
                        
                        @if($tweet->replies->count())
                            <ul class="list-group replies">
                                @foreach ($tweet->replies as $reply)
                                    {{ View::make('tweet_each', array(
                                        'username' => $reply->author->username,
                                        'fullname' => $reply->author->fullname,
                                        'date' => $reply->created_at,
                                        'text' => $reply->text,
                                        'id' => $reply->id,
                                        'reply_button'=> false,
                                        'retweet_button'=> false,
                                        'retweeted' => false
                                    )) }}
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop