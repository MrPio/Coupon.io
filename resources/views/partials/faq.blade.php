@props([
    'id'=>'',
    'question'=>'',
    'answer'=>'',
])

<link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
<link rel="stylesheet" href="{{asset('/css/partials/faq.css')}}">

<div class="faq-container">
    <div class="accordion">
        <div class="accordion-item">
            <a class="faq-question" id="{{$id}}"><strong>{{$question}}?</strong></a>
            <div class="content">
                <p id="{{$id}}">{{$answer}}</p>
            </div>
        </div>
        @can('isAdmin')
            <div class="right-container">
                <div class="edit-object center-content">
                    <div class="button-container edit-button-container center-content">
                        <a href="{{route('faqs.edit', [$faq])}}">
                            <svg viewBox="0 0 512 512" width="40.37" height="38.4">
                                <path
                                    d="M290.74 93.24l128.02 128.02-277.99 277.99-114.14 12.6C11.35 513.54-1.56 500.62.14 485.34l12.7-114.22 277.9-277.88zm207.2-19.06l-60.11-60.11c-18.75-18.75-49.16-18.75-67.91 0l-56.55 56.55 128.02 128.02 56.55-56.55c18.75-18.76 18.75-49.16 0-67.91z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="delete-object center-content">
                    <div class="button-container delete-button-container center-content">
                        <button type="submit" style="background-color: rgb(0, 0, 0, 0); border: none">
                            <svg viewBox="64 64 896 896" width="43.74" height="41.6">
                                <path
                                    d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-200 0H360v-72h304v72z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endcan
    </div>
</div>



