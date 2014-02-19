<li class="list-group-item">
    <div class="row">
        <div class="col-md-6">
            {{ HTML::link(
                URL::route('findUser', array('name' => $username)),
                $fullname,
                array('class' => 'fullname')
            ) }}
            {{ HTML::link(
                URL::route('findUser', array('name' => $username)),
                '@'.$username,
                array('class' => 'label label-primary')
            ) }}
        </div>
        <div class="col-md-6">
            <span class="label label-success pull-right">{{ date_format($date, 'H:i:s Y.m.d') }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">{{ $text }}</div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="btn btn-primary btn-xs pull-right retweet" for="{{ $id }}">
                <span class="glyphicon glyphicon-retweet"></span>
            </div>
            @if($reply_button)
                <div class="btn btn-success btn-xs pull-right reply" data-toggle="modal" data-target=".reply-modal" for="{{ $id }}">
                    <span class="glyphicon glyphicon-share-alt"></span>
                </div>
            @endif
        </div>
    </div>
</li>