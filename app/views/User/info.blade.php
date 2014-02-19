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
                            <div class="count-description">Tweets:</div>
                            <a href="#" class="count">{{ $user->tweets()->count() }}</a>
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Following:</div>
                            <a href="#" class="count">{{ $user->following()->count() }}</a>
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Followers:</div>
                            <a href="#" class="count">{{ $user->followers()->count() }}</a>
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
                    @foreach ($user->tweets()->get() as $tweet)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="#" class="fullname">{{ $tweet['author']->fullname }}</a>
                                    <a href="#" class="label label-primary">{{ '@'.$tweet['author']->username }}</a>
                                </div>
                                <div class="col-md-6">
                                    <span class="label label-success pull-right">{{ date_format($tweet['created_at'], 'H:i:s Y.m.d') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">{{ $tweet['text'] }}</div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop