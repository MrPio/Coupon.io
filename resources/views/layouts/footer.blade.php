<head>
    <title>Footer Design</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{asset('css/layouts/footer.css')}}">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>


<div id="pre_footer"></div>
<footer class="footer">
    <div class="footer-container">
        <div class="row" style="justify-content: center">
            <div class="footer-col">
                <h4 class="company">Coupon.io</h4>
                <ul>
                    <li><a href="{{ route('who') }}">Chi siamo</a></li>
                    <li><a href="{{ route('where') }}">Dove siamo</a></li>
                    <li><a href="{{ route('aziende') }}">Aziende affiliate</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4 class="help">Informazioni</h4>
                <ul>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
            </div>
{{--            <div class="footer-col">--}}
{{--                <h4 class="shop">online shop</h4>--}}
{{--                <ul>--}}
{{--                    <li><a href="/account">Ok, ora puoi cancellarmi</a></li>--}}
{{--                </ul>--}}
{{--            </div>--}}
            <div class="footer-col">
                <h4 class="follow">follow us</h4>
                <div class="social-links">
                    <a href="https://www.facebook.com/couponio"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.twitter.com/couponio"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/couponio"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/couponio"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

