here at tenant welcome


Logout
<form method="POST" action="{{ url('logout') }}" method="post">
    @csrf

    <button onclick="event.preventDefault();
                                                this.closest('form').submit();">
        {{ __('Logout') }}
    </button>
</form>