<input {{ $attributes->merge([
    'value' => request()->old($attributes->get('name'))
]) }}>