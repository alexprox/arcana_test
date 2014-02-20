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
        @if(Auth::check() && $user->id != Auth::user()->id)
            <div class="col-md-6">
                @if(Auth::user()->following()->find($user->id))
                    <button class="btn btn-warning btn-xs follow-toggle" for="{{ $user->id }}">Unfollow</button>
                @else
                    <button class="btn btn-info btn-xs follow-toggle" for="{{ $user->id }}">Follow</button>
                @endif
            </div>
        @endif
    </div>
</li>