<li class="list-group-item">
    <div class="row">
        <div class="col-md-6">
            {{ HTML::link(
                URL::route('findUser', array('name' => $tweet->author->username)),
                $tweet->author->fullname,
                array('class' => 'fullname')
            ) }}
            {{ HTML::link(
                URL::route('findUser', array('name' => $tweet->author->username)),
                '@'.$tweet->author->username,
                array('class' => 'label label-primary')
            ) }}
        </div>
        <div class="col-md-6">
            @if($tweet->retweet)
                <span class="label label-danger">(retweeted)</span>
            @endif
            <span class="label label-success pull-right">{{ date_format($tweet->created_at, 'H:i:s Y.m.d') }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">{{ $tweet->retweet?$tweet->retweet->text:$tweet->text }}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if(!$tweet->tweet_id)
                <div class="btn btn-primary btn-xs pull-right retweet" for="{{ $tweet->retweet?$tweet->retweet->id:$tweet->id }}">
                    <span class="glyphicon glyphicon-retweet"></span>
                </div>
            @endif
            @if($tweet->author->id != Auth::user()->id)
                <div class="btn btn-success btn-xs pull-right reply" data-toggle="modal" data-target=".reply-modal" for="{{ $tweet->id }}">
                    <span class="glyphicon glyphicon-share-alt"></span>
                </div>
            @endif
        </div>
    </div>
</li>