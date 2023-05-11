@props(['type' => 'info', 'dismissible' => false])

<link rel="stylesheet" href="{{ asset('css/components/alert.css') }}">
<div class="alert alert-{{ $type }}">
    @if ($dismissible)
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    @endif
    {{ $slot }}
</div>

{{--usage:--}}

{{--    @component('components.alert', ['type' => 'warning', 'dismissible' => true])--}}
{{--        <strong>Warning!</strong> This is a warning message.--}}
{{--    @endcomponent--}}