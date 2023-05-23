@extends('layouts.management')

@can('isStaff')
    @section('content')
        <div style="display: flex; ">
            <div
                style="height: 650px; position: sticky;top: 10px; /* regola l'altezza del div dal top della finestra di visualizzazione */">
                @include('partials.user_card')
            </div>
            @include('layouts.user_account_content')

        </div>
    @endsection
@endcan

@can('isAdmin')
    @section('content')
        <div style="display: flex; ">
            <div
                style="height: 650px; position: sticky;top: 10px; /* regola l'altezza del div dal top della finestra di visualizzazione */">
                @include('partials.user_card')
            </div>
            @include('layouts.user_account_content')

        </div>
    @endsection
@endcan
