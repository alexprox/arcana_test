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
                            <div class="count-description">Tweets:</div>
                            {{ HTML::link(
                                URL::route('findUser', array('name' => Auth::user()->username)),
                                Auth::user()->tweets()->count(),
                                array('class' => 'count')
                            ) }}
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Following:</div>
                            {{ HTML::link(
                                URL::route('findUser', array('name' => Auth::user()->username)),
                                Auth::user()->following()->count(),
                                array('class' => 'count')
                            ) }}
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Followers:</div>
                            {{ HTML::link(
                                URL::route('findUser', array('name' => Auth::user()->username)),
                                Auth::user()->followers()->count(),
                                array('class' => 'count')
                            ) }}
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
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ HTML::link(
                                        URL::route('findUser', array('name' => $tweet['author']->username)),
                                        $tweet['author']->fullname,
                                        array('class' => 'fullname')
                                    ) }}
                                    {{ HTML::link(
                                        URL::route('findUser', array('name' => $tweet['author']->username)),
                                        '@'.$tweet['author']->username,
                                        array('class' => 'label label-primary')
                                    ) }}
                                </div>
                                <div class="col-md-6">
                                    <span class="label label-success pull-right">{{ date_format($tweet['created_at'], 'H:i:s Y.m.d') }}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">{{ $tweet['text'] }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="btn btn-primary btn-xs pull-right" for="{{ $tweet->id }}">
                                        <span class="glyphicon glyphicon-retweet"></span>
                                    </div>
                                    @if($tweet['author']->id != Auth::user()->id)
                                        <div class="btn btn-success btn-xs pull-right reply" data-toggle="modal" data-target=".reply-modal" for="{{ $tweet->id }}">
                                            <span class="glyphicon glyphicon-share-alt"></span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@stop