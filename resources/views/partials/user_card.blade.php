<link rel="stylesheet" href="{{asset('/css/partials/user_card.css')}}">


<div class="user--container">
    {{--    $user->image_path    storage/app/public/{{$user->image_path}}--}}

    <div class="user--image"
         style="@if($user->image_path != null)background-image: url(storage/{{$user->image_path}});  @else background-image: url(../../images/account_default_img.png); @endif">


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


        <div class="user--name"><h1>{{$user->name . " " . $user->surname}}</h1></div>
        <div class="user--role" style="display: flex;"><h3>{{$user->role()}}</h3>
            @if($user->role() == 'staff' && $user->privileged)
                <div class="privilege--image" style="background-image: url(../../images/crown.png);"></div>
            @endif
        </div>
    </div>
</div>


<script>
    document.getElementById('input_file').addEventListener("change", function (){
        document.getElementById('sendButton').click()
  })
</script>
