@extends('layouts.public')
@section('title', 'FAQ')

@section('header')

@endsection

@section('subHeader')

@endsection

@section('content')
    {{--Domande--}}
    <div class="padding" style="margin-top: 80px;">
        {{--        @include('partials.section_title',['title'=>'FAQ'])--}}
        @foreach($faqs as $faq)
            @include('partials.faq',
                [
                    'question'=>$faq->question,
                    'answer'=>$faq->answer,
                ])
        @endforeach
    </div>
    <script>
        const items = document.querySelectorAll(".accordion a");

        function toggleAccordion() {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
        }

        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
@endsection
