@guest
    @if (Route::has('login'))
    <h1>guest</h1>
    @endif

    @if (Route::has('register'))
    @endif
@else
   <h1>HOLA {{ Auth::user()->name }} </h1> 
<h1>logued</h1>

<a class="dropdown-item text-white" href="{{ route('logout') }}"
    onclick="event.preventDefault();
                 document.getElementById('logout-form').submit();">
    {{ __('Logout') }}
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none ">
    @csrf
</form>
</div>

@endguest

<a href="/register">register</a>
<a href="/loginsView">login</a>

<div>

