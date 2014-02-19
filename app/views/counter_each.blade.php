<div class="count-description">{{ $text }}:</div>
{{ HTML::link(
    URL::route('findUser', array('name' => $username)),
    $count,
    array('class' => 'count')
) }}