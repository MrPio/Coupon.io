@extends('layouts.public')
@section('title', 'FAQ')

@section('header')

@endsection

@section('subHeader')

@endsection

@section('content')
    {{--Domande--}}
    <div class="padding" style="margin-top: 80px;">
        @include('partials.section_title',['title'=>'FAQ'])
        <div class="grid_responsive" style="padding-top: 100px";>
            @foreach($faqs as $faq)
                @include('partials.faq',
                    [
                        'question'=>$faq->question,
                        'answer'=>$faq->answer,
                    ])
            @endforeach
        </div>
    </div>
    <script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
    <script>
        const items = document.querySelectorAll(".accordion a");

        function toggleAccordion() {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
        }

        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
@endsection
