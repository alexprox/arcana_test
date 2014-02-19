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
            @if($show_buttons)
                follow...
            @endif
        </div>
    </div>
</li>