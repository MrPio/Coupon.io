@props([
    'faqs'=>[]
])

@php
    $is_public=Gate::allows('isPublic') || !Auth::check();
@endphp
<link rel="stylesheet" href="{{asset('/css/partials/faq.css')}}">

@extends($is_public?'layouts.public':'layouts.management',
$is_public?[]:['title'=>'Tutte le FAQ','subtitle'=>'Cliccando sui pulsanti puoi modificare o eliminare la FAQ.'])

@section('title', 'FAQ')

@section('content')

    <div class="{{$is_public?'padding':''}}" style="margin-top: {{$is_public?'80':'20'}}px">

        @if($is_public)
            @include('partials.section_title', ['title' => 'FAQ'])
        @endif

        <div style="margin-top: 50px">
            @foreach($faqs as $faq)
                @include('partials.faq',
                    [
                        'id'=>$faq->id,
                        'question'=>$faq->question,
                        'answer'=>$faq->answer,
                    ])
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    @parent
    <script>
        function toggleAccordion() {
            this.classList.toggle('active');
            this.nextElementSibling.classList.toggle('active');
        }

        $(() => {
            const items = document.querySelectorAll(" .accordion a");
            items.forEach(item => item.addEventListener('click', toggleAccordion));
        })
    </script>
@endsection




