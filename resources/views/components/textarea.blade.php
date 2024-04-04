<textarea {{ $attributes }}>{{ $slot !="" ? $slot : old($attributes->get('name')) }}</textarea>
<x-error name="{{ $attributes->get('name') }}" />