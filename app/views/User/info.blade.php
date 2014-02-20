@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 row">
        <div class="col-md-4">
            <div class="panel panel-default profile">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">{{ $user->fullname }}</h3>
                    {{ "@".$user->username }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => $user->username,
                                'count' => $tweets->count(),
                                'text' => 'Tweets'
                            )) }}
                        </div>
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => $user->username,
                                'count' => $user->following->count(),
                                'text' => 'Following'
                            )) }}
                        </div>
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => $user->username,
                                'count' => $user->followers->count(),
                                'text' => 'Followers'
                            )) }}
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    a
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
                        @if(!$tweet->tweet_id)
                            {{ View::make('tweet_each', array('tweet' => $tweet)) }}

                            @if($tweet->replies->count())
                                <ul class="list-group replies">
                                    @foreach ($tweet->replies as $reply)
                                        {{ View::make('tweet_each', array('tweet' => $reply)) }}
                                    @endforeach
                                </ul>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-10 col-md-offset-1 row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Followers</h3>
                </div>
                <ul class="list-group tweets">
                    @foreach ($user->followers as $user_f)
                        {{ View::make('user_each', array(
                            'username' => $user_f->username,
                            'fullname' => $user_f->fullname,
                            'show_buttons'=> false
                        )) }}
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Following</h3>
                </div>
                <ul class="list-group tweets">
                    @foreach ($user->following as $user_f)
                        {{ View::make('user_each', array(
                            'username' => $user_f->username,
                            'fullname' => $user_f->fullname,
                            'show_buttons'=> false
                        )) }}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop