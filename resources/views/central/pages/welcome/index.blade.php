here at central welcome


<form method="POST" action="{{ url('logout') }}" method="post">
    @csrf
    @if(Auth::check())
    <button type="submit">logout</button>
    @else
        <a href="{{ url('login') }}">login</a>
    @endif
</form>