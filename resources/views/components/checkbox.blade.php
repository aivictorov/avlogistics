<div class="form-checkbox-wrapper">
    <input class="form-checkbox"
        {{ $attributes->merge([
            'value' => request()->old($attributes->get('name')),
        ]) }}>
    <span>
        @yield('text')
    </span>
</div>
<x-error name="{{ $attributes->get('name') }}" />
