<link rel="stylesheet" href="{{asset('/css/partials/user_card.css')}}">

<div class="user--container">

    <div class="user--image"
         style="
         @if($account->image_path != null)
         background-image: url({{asset('storage/'.$account->image_path)}});
         @else
         background-image: url({{asset('images/account_default_img.png')}});
         @endif">


        <form action="{{route('account')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="file" id="input_file" name="imageInput" style="display: none;">
            <!-- Input per selezionare l'immagine -->

            <button type="button" onclick="document.getElementById('input_file').click()" class="change--user--image"
                    style="background-image: url(../../images/brush.png);"></button>

            <button type="submit" id="sendButton" style="display: none;"></button>
            {{--            button di invio della form--}}

        </form>


    </div>
    <div class="user-details">


        <div class="user--name"><h1>{{$account->name . " " . $account->surname}}</h1></div>
        <div class="user--role" style="display: flex;"><h3>{{$account->role()}}</h3>
            @if($account->role() == 'staff' && $account->privileged)
                <div class="privilege--image" style="background-image: url(../../images/crown.png);"></div>
            @endif
        </div>
    </div>
</div>


<script>
    document.getElementById('input_file').addEventListener("change", function () {
        document.getElementById('sendButton').click()
    })
</script>
