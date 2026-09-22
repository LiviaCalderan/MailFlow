@props([
    'post' => null,
    'put' => null,
    'delete' => null,
    'patch' => null,
])

@php
    $method = ($post || $put || $delete || $patch) ? 'post' : 'get';
@endphp

<form {{ $attributes }} method="post">
    @csrf

    @if ($put)
        @method('put')
    @endif

    @if ($delete)
        @method('delete')
    @endif

    @if ($patch)
        @method('patch')
    @endif

    {{ $slot }}
</form>