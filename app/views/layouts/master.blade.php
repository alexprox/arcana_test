<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?= csrf_token() ?>">
        <title>Sparrow</title>

        <!-- Bootstrap -->
        {{ HTML::style('css/bootstrap.min.css') }}
        {{ HTML::style('css/css.css') }}

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        @include('navigation')
        <div class="container">
            @yield('content')
            @include('footer')
        </div>
        <div class="modal fade reply-modal" tabindex="-1" role="dialog" aria-labelledby="Reply" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Reply</h4>
                    </div>
                    {{ Form::open(array('route' => 'replyTweet', 'class' => 'form-horizontal-no-label')) }}
                        <div class="modal-body">
                            {{ Form::hidden('tweet_id') }}
                            {{ Form::textarea('tweet', NULL, array("class"=>"form-control", "placeholder"=>"Write reply", "rows" => 1)) }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <span class="counter badge pull-left" for="tweet" max="140">140</span>
                            {{ Form::submit('Tweet', array("class"=>"btn btn-primary pull-right ajax")) }}
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        {{ HTML::script('js/jquery.min.js') }}
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/js.js') }}
    </body>
</html>
