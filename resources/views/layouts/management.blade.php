{{--@inject('gate', 'Illuminate\Support\Facades\Gate')--}}
<!DOCTYPE html>
<html id="man-html" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/misc/company.css') }}">
        <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
        <title>Coupon.io | @yield('title', 'Home')</title>
    </head>
    <body id="man-body">
        <div class="man-header">
            <h1>Salve {{ Auth::user()->name }}</h1>
            <div class="man-logout-button">
            @auth('web')
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    @include('partials.button',['text' => 'Esci','icon' => 'user.svg', 'id'=>'logout_button','form_type' => 'submit'])
                </form>
            @endauth
            </div>
        </div>
        <div id="man-container">
            @can('isAdmin')
                @include('partials/sidebar_admin')
            @endcan
            @can('isStaff')
                @include('partials/sidebar_staff')
            @endcan
            <div id="man-content">
                @yield('content')
            </div>
        </div>

        {{-- TODO: put the script in a separate file --}}
        <script>
            let buttons = document.querySelectorAll('.menu-button');

            let secondary_lists = document.querySelectorAll('.sidebar-secondary-list');

            jQuery('.man-main-item:nth-child(odd)').addClass('striped');

            for (let i = 0; i < buttons.length; i++) {
                buttons[i].addEventListener('click', function(event, index=i){
                    for (let j = 0; j < secondary_lists.length; j++) {
                        if (j !== index) {
                            secondary_lists[j].style.display = "none";
                        }
                    }
                    let parent = event.target.parentNode;
                    let list = parent.children[1];
                    if (list.style.display === "list-item") {
                        list.style.display = "none";
                    } else {
                        list.style.display = "list-item";
                    }
                });
            }
        </script>
    </body>
</html>
