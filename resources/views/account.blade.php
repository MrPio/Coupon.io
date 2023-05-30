@extends('layouts.public')

@section('content')
<link rel="stylesheet" href="{{asset('css/layouts/account.css')}}">
    <div class="padding account--container">
        <div style="height: 650px; position: sticky;top: 10px; /* regola l'altezza del div dal top della finestra di visualizzazione */">
            @include('partials/user_card')
        </div>
        @include('layouts.user_account_content')
    </div>
@endsection



