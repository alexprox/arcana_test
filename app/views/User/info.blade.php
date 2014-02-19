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
                            <div class="count-description">Tweets:</div>
                            {{ HTML::link(
                                URL::route('findUser', array('name' => $user_info->username)),
                                $user_info->tweets()->count(),
                                array('class' => 'count')
                            ) }}
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Following:</div>
                            {{ HTML::link(
                                URL::route('findUser', array('name' => $user_info->username)),
                                $user_info->following()->count(),
                                array('class' => 'count')
                            ) }}
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Followers:</div>
                            {{ HTML::link(
                                URL::route('findUser', array('name' => $user_info->username)),
                                $user_info->followers()->count(),
                                array('class' => 'count')
                            ) }}
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
                    @foreach ($user_info->tweets()->get() as $tweet)
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
                        </li>
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
                    @foreach ($user_info->followers()->get() as $user)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ HTML::link(
                                        URL::route('findUser', array('name' => $user->username)),
                                        $user->fullname,
                                        array('class' => 'fullname')
                                    ) }}
                                    {{ HTML::link(
                                        URL::route('findUser', array('name' => $user->username)),
                                        '@'.$user->username,
                                        array('class' => 'label label-primary')
                                    ) }}
                                </div>
                                <div class="col-md-6">
                                    
                                </div>
                            </div>
                        </li>
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
                    @foreach ($user_info->following()->get() as $user)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ HTML::link(
                                        URL::route('findUser', array('name' => $user->username)),
                                        $user->fullname,
                                        array('class' => 'fullname')
                                    ) }}
                                    {{ HTML::link(
                                        URL::route('findUser', array('name' => $user->username)),
                                        '@'.$user->username,
                                        array('class' => 'label label-primary')
                                    ) }}
                                </div>
                                <div class="col-md-6">
                                    
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