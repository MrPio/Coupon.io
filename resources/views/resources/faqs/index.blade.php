@props([
    'faqs'=>[]
])

@php
    $is_public=Gate::allows('isPublic') || !Auth::check();
@endphp

@extends($is_public?'layouts.public':'layouts.management',
$is_public?[]:['title'=>'Tutte le FAQ','subtitle'=>'Cliccando sui pulsanti puoi modificare o eliminare la FAQ.'])

@section('title', 'FAQ')

@section('content')

    <div class="{{$is_public?'padding':''}}" style="margin-top: {{$is_public?'80':'20'}}px">

        @if($is_public)
            @include('partials.section_title', ['title' => 'FAQ'])
        @endif

        @foreach($faqs as $faq)
            @include('partials.faq',
                [
                    'id'=>$faq->id,
                    'question'=>$faq->question,
                    'answer'=>$faq->answer,
                ])
        @endforeach
    </div>
    <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    <script>
        const items = document.querySelectorAll(" .accordion a");

        function toggleAccordion() {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
        }

        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
@endsection




