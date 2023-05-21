@props([
    'image'=>'account_default_img.png',
])


<link rel="stylesheet" href="{{asset('/css/partials/user_card.css')}}">


<div class="user--container">
{{--    $user->image_path--}}

        <div class="user--image" style="@if($user->image_path)background-image: url({{$user->image_path}});  @else background-image: url(../../images/{{$image}}); @endif">

            <div class="change--user--image" style="background-image: url(../../images/brush.png);">

                <form action="{{route('account')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="imageInput"> <!-- Input per selezionare l'immagine -->

                    <button type="submit"><img alt="Preview" id="previewImage" src="/public/images/crown.png"></button> <!-- Immagine di anteprima predefinita -->

                </form>

            </div>


        </div>
    <div class="user-details">


        <div class="user--name"><h1>{{$user->name . " " . $user->surname}}</h1></div>
        <div class="user--role" style="display: flex;"><h3>{{$user->role()}}</h3>
            @if($user->role() == 'staff' && $user->privileged) <div class="privilege--image" style="background-image: url(../../images/crown.png);"></div>@endif
        </div>
    </div>
</div>
