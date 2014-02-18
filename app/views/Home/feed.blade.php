@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4 row">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Welcome to Sparrow.</h3>
                <p>Start a conversation, explore your interests, and be in the know.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Sign In</div>
                    <div class="panel-body">
                        {{ Form::open(array('route' => 'signIn', 'class' => 'form-horizontal-no-label')) }}
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">@</span>
                                {{ Form::text('username', NULL, array("class"=>"form-control", "placeholder"=>"Username")) }}
                            </div>
                            {{ Form::password('password', array("class"=>"form-control input-sm", "placeholder"=>"Password")) }}
                            {{ Form::submit('Sign in', array("class"=>"btn btn-primary btn-sm pull-right ajax")) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Sign up</div>
                    <div class="panel-body">
                        {{ Form::open(array('route' => 'signUp', 'class' => 'form-horizontal-no-label')) }}
                            {{ Form::text('fullname', NULL, array("class"=>"form-control input-sm", "placeholder"=>"Full name")) }}
                            <div class="input-group input-group-sm">
                                <span class="input-group-addon">@</span>
                                {{ Form::text('username', NULL, array("class"=>"form-control", "placeholder"=>"Username")) }}
                            </div>
                            {{ Form::password('password', array("class"=>"form-control input-sm", "placeholder"=>"Password")) }}
                            {{ Form::submit('Sign up for Sparrow', array("class"=>"btn btn-success btn-sm pull-right ajax")) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop