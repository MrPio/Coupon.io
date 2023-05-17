@extends('layouts.public')
@section('title', 'Where')

@section('header')

@endsection

@section('subHeader')

@endsection

@section('content')
    {{--Posizione--}}
    <link rel="stylesheet" href="{{asset('css/partials/where.css')}}">
    <div class="padding" style="margin-top: 100px;">
        @include('partials.section_title',['title'=>'Dove siamo'])
        <div class="google_map">
            <div class="container_description">
                <h2 style="padding-bottom: 20px"><strong>Contatti</strong></h2>
                <table class="table">
                    <tr>
                        <th class="style_th">Indirizzo:</th>
                        <td class="style_td">Via Brecce Bianche, 60131 Ancona AN</td>
                    </tr>
                    <tr>
                        <th class="style_th">Telefono:</th>
                        <td class="style_td">+0734 845678</td>
                    </tr>
                    <tr>
                        <th class="style_th">E-mail:</th>
                        <td class="style_td"><a href="mailto:coupon:io@gmail.com">coupon.io@gmail.com</a></td>
                    </tr>
                    {{--                        <ul class="list">--}}

                    {{--                            --}}{{--                        <li><strong>Indirizzo: Via Brecce Bianche, 60131 Ancona AN</strong></li>--}}
                    {{--                            --}}{{--                        <li><strong>Telefono: +0734 845678</strong></li>--}}
                    {{--                            --}}{{--                        <li><strong>E-mail:<a href="mailto:coupon:io@gmail.com">coupon.io@gmail.com</a></strong></li>--}}
                    {{--                        </ul>--}}

                </table>
            </div>
            <iframe
                class="map"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2889.8963015057925!2d13.513717454350166!3d43.58787625224827!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x132d80235c260cdf%3A0x3ec7eb70115b435b!2sUniversit%C3%A0%20Politecnica%20delle%20Marche%20-%20Segreteria%20Studenti%20di%20Ingegneria%20-%20Agraria%20-%20Scienze!5e0!3m2!1sit!2sit!4v1684144597567!5m2!1sit!2sit"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrad"></iframe>
        </div>
    </div>
@endsection
