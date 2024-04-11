@if (Session::has('notice'))
    <div class="form-group alert alert-success">
        <ul class="mb-0 pl-2">
            {{-- @foreach ($errors->all() as $message) --}}
            {{-- <li> --}}
            {{ Session::get('notice') }}
            {{-- </li> --}}
            {{-- @endforeach --}}
        </ul>
    </div>
@endif
