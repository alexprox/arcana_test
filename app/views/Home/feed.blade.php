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
                            <a href="#" class="count">0</a>
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Following:</div>
                            <a href="#" class="count">0</a>
                        </div>
                        <div class="col-md-4">
                            <div class="count-description">Followers:</div>
                            <a href="#" class="count">0</a>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    {{ Form::open(array('route' => 'signIn', 'class' => 'form-horizontal-no-label')) }}
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
                <ul class="list-group">
                    @for ($i = 0; $i < 10; $i++)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-12">@user</div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">tesxwetw</div>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
@stop