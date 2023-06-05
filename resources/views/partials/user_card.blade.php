<link rel="stylesheet" href="{{asset('/css/partials/user_card.css')}}">

<div class="user--container">

    <div class="user--image"
         style="
         @if($account->image_path != null && file_exists('storage/'.$account->image_path))
         background-image: url({{asset('storage/'.$account->image_path)}});
         @else
         background-image: url({{asset('images/account_default_img.png')}});
         @endif">


        <form id="user--image_form" action="{{route('account.photo')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" id="input_file" name="imageInput" style="display: none;">
            <!-- Input per selezionare l'immagine -->

            <button type="button" onclick="document.getElementById('input_file').click()" class="change--user--image"
                    style="background-image: url({{ asset('images/brush.png') }});"></button>

            <button type="submit" id="sendButton" style="display: none;"></button>
            {{--            button di invio della form--}}

        </form>


    </div>
    <div class="user-details">
        <div class="user--name"><h1>{{$account->name . " " . $account->surname}}</h1></div>
        <div class="user--role" style="display: flex;"><h3>{{$account->role()}}</h3>
            @if($account->role() == 'staff' && $account->staff->privileged)
                <div class="privilege--image" style="background-image: url(../../images/crown.png);"></div>
            @endif
        </div>
    </div>

    <div class="man-logout-button">
        @auth('web')
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                @include('partials.button',['text' => 'Esci','icon' => 'user_white.svg', 'id'=>'logout_button','form_type' => 'submit','black'=>true,'big'=>true])
            </form>
        @endauth
    </div>
</div>

<script src="{{asset('js/functions.js')}}"></script>
<script>
    document.getElementById('input_file').addEventListener("change", function () {
        document.getElementById('sendButton').click()
    })
    $('#sendButton').on('click', (e) => {
        e.preventDefault();
        sendPostAJAX({
            formId: 'user--image_form',
            url: "{{route('account.photo')}}",
            onSuccess: (msg) => window.location=msg['redirect'],
        })
    })
</script>
