
{{-- Si hay error en la sesión --}}
@if(Session::has('message'))
<div class="container-fluid">
    <div class="erroralert alert alert-{{ Session::get('typealert') }}" id="alert" style="display:block;">
        {{ Session::get('message') }}
        @if ($errors->any())
        <ul>
            <br>
            @foreach($errors->all() as $error)

            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif

<button type="button" class="btn-close outnone float-end" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
