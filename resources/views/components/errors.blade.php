@if ($errors->any())
    <div class="form-group alert alert-danger">
        <ul class="mb-0 pl-4">
            @foreach ($errors->all() as $message)
                <li>
                    {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
