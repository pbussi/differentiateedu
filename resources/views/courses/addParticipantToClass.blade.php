
@if (auth()->check())
    <form action="" method="post">
        <button type="submit" class="btn blue no-margin">
            Unirse a la clase
        </button>
     
    </form>
@else
    <a href="{{ url('/login?redirect_to='.url()->current()) }}" class="btn blue no-margin">
        Unirse 
    </a>
@endif