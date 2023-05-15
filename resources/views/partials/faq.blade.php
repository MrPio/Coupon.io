<link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
<link rel="stylesheet" href="{{asset('css/partials/faq.css')}}">
<div class="container">
    <div class="accordion">
        <div class="accordion-item">
            <a ><strong>Chi siamo?</strong></a>
            <div class="content">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra
                    suspendisse potenti.</p>
            </div>
        </div>
        {{--        <div class="accordion-item">--}}
        {{--            <a><strong>Dove siamo?</strong></a>--}}
        {{--            <div class="content">--}}
        {{--                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore--}}
        {{--                    et dolore magna aliqua. Elementum sagittis vitae et leo duis ut. Ut tortor pretium viverra--}}
        {{--                    suspendisse potenti.</p>--}}
        {{--            </div>--}}
        {{--        </div>--}}
    </div>
</div>
<script src='https://code.jquery.com/jquery-3.2.1.min.js'></script>
<script>
    const items = document.querySelectorAll(".accordion a");

    function toggleAccordion() {
        this.classList.toggle('active');
        this.nextElementSibling.classList.toggle('active');
    }

    items.forEach(item => item.addEventListener('click', toggleAccordion));
</script>

