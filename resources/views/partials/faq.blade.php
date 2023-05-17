@props([
    'question'=>'',
    'answer'=>'',
])

<link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
<link rel="stylesheet" href="{{asset('/css/partials/faq.css')}}">
<div class="faq-container">
    <div class="accordion">
        <div class="accordion-item">
            <a><strong>{{$question}}?</strong></a>
            <div class="content">
                <p>{{$answer}}</p>
            </div>
        </div>
    </div>
</div>


