<div class="row">
    <div class="col-md-12">
        <div class="footer">
            <ul class="list-inline">
                @if (Auth::check())
                    <li>
                        {{ HTML::link(URL::route('signOut'), 'Sign out') }}
                    </li>
                @endif
                <li>
                    <span>© 2014 Sparrow</span>
                </li>
            </ul>
        </div>
    </div>
</div>