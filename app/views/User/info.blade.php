@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 row">
        <div class="col-md-4">
            <div class="panel panel-default profile">
                <div class="panel-heading text-center">
                    <h3 class="panel-title">{{ $user_info->fullname }}</h3>
                    {{ "@".$user_info->username }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => $user_info->username,
                                'count' => $user_info->tweets->count(),
                                'text' => 'Tweets'
                            )) }}
                        </div>
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => $user_info->username,
                                'count' => $user_info->following->count(),
                                'text' => 'Following'
                            )) }}
                        </div>
                        <div class="col-md-4">
                            {{ View::make('counter_each', array(
                                'username' => $user_info->username,
                                'count' => $user_info->followers->count(),
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
                    @foreach ($user_info->tweets as $tweet)
                        {{ View::make('tweet_each', array(
                            'username' => $tweet->author->username,
                            'fullname' => $tweet->author->fullname,
                            'date' => $tweet->created_at,
                            'text' => $tweet->text,
                            'id' => $tweet->id,
                            'reply_button' => Auth::user()->id != $tweet->author_id
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
                                        'reply_button' => false
                                    )) }}
                                @endforeach
                            </ul>
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
                    @foreach ($user_info->followers as $user)
                        {{ View::make('user_each', array(
                            'username' => $user->username,
                            'fullname' => $user->fullname,
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
                    @foreach ($user_info->following as $user)
                        {{ View::make('user_each', array(
                            'username' => $user->username,
                            'fullname' => $user->fullname,
                            'show_buttons'=> false
                        )) }}
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop