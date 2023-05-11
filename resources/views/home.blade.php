<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>Cupon.io</title>
</head>
<body>
<div id="wrapper">
    <div id="page">

        {{-- Top yellow block --}}
        <div id="top_block">
            <div class="padding" style="margin-bottom: 40px">
                <div id="row">

                    {{-- Logo --}}
                    <div id="logo">
                        <p>IMG</p>
                        <p>Cupon.io</p>
                    </div>

                    {{-- Navbar --}}
                    <div id="navbar">
                        <ul>
                            <li><a href="" title="Home">Home</a></li>
                            <li><a href="" title="Catalogo">Catalogo</a></li>
                            <li><a href="" title="Aziende">Aziende</a></li>
                            <li><a href="" title="Categorie">Categorie</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <h1>The Perfect<br>Coupons Just For You</h1>
            <h4>Discover the best offers from the best brandes.<br>All our offers are constantly up-to-date,</h4>
            <div id="row">
                <div id="button_white">Explore more</div>
                <div id="button_black">Who we are</div>
            </div>
        </div>

        {{-- Purple block--}}
        <div id="block_purple" style="margin-top: -50px">
            @include('helpers.section_title',['title'=>'Le nostre Aziende','imgFile'=>'line_white.svg', 'color'=>'#ffffff'])
        </div>

        {{-- Oblique purple separator --}}
        <img src="{{asset('images/wave001.svg')}}" alt="non disponibile"
             style="margin: -1px 0 0 -4px">
    </div>



    {{-- Categorie --}}
    <div class="padding" style="margin-top: 80px">
        @include('helpers.section_title',['title'=>'Il nostro catalogo'])
    </div>

    {{-- Coupon in evidenza --}}
    <div class="padding" style="margin-top: 80px">
        @include('helpers.section_title',['title'=>'Cupon in evidenza'])
    </div>

    {{-- Riguardo noi --}}
    <div class="padding" style="margin-top: 80px">
        @include('helpers.section_title',['title'=>'Riguardo noi'])
        <div class="grid_layout " style="margin-top: 40px">
            @include('helpers.about_us_element', ['image_file' => 'about_us_1.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor'])
            @include('helpers.about_us_element', ['image_file' => 'about_us_2.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor'])
            @include('helpers.about_us_element', ['image_file' => 'about_us_3.png', 'title' => 'Frequently Asked Questions','subtitle' => 'Lorem ipsum dolor sit amen lorem ispus dolor'])
        </div>
    </div>

    {{-- Footer --}}
    <div id="pre_footer">
        <div id="footer" class="padding">
            <br>
            <p>universit&agrave; politecnica delle marche</p>
        </div>
    </div>
</div>
</body>
</html>
