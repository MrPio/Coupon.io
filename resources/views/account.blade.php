{{--
@php
$is_public=Gate::allows('isPublic');
@endphp

@extends($is_public ? 'layouts.public' : 'layouts.management')

@section('title', 'Account')

@section('content')
    <link rel="stylesheet" href="{{asset('css/layouts/account.css')}}">
    <div class="account--container">
        <div
            style="height: 650px; position: sticky;top: 10px; /* regola l'altezza del div dal top della finestra di visualizzazione */">
            @include('partials/user_card')
        </div>
        @include('partials.user_account_content')
    </div>
@endsection



--}}
