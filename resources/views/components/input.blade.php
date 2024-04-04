{{-- @props(['name' => '']) --}}

<input {{ $attributes->merge([
    'value' => request()->old($attributes->get('name')),
]) }}>
<x-error name="{{ $attributes->get('name') }}" />