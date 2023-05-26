@extends('layouts.management')

@section('content')
        <div class="man-header">
            <h2>Bentornato, {{Auth::user()->name}}</h2>
            <p>Questa è la tua dashboard da {{Gate::allows('isAdmin')?'amministratore':'membro dello staff'}}</p>
        </div>
@endsection
