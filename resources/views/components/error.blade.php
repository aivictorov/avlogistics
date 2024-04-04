@props(['name' => ''])

@error($name)
    <div class="small text-danger">{{ $message }}</div>
@enderror