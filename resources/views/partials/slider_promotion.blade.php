<link rel="stylesheet" href="{{asset('css/partials/slider.css')}}">


<div class="promotion-wrapper">
    <ul class="promotion-items">
        @foreach ($promotions as $promotion)
            @if($promotion->featured)
                <li class="promotion-item">@include('partials.coupon',
                [
                'promotion_id' => $promotion->id,
                    'title'=>$promotion->product->name,
                    'expiration'=>$promotion->ends_on,
                    'image'=>$promotion->product->image_path,
                    'discount_perc'=>$promotion->percentage_discount,
                    'discount_tot'=>$promotion->flat_discount,
                ])</li>
            @endif
        @endforeach
        <li style="margin-left: 20px; margin-right: 20px;">@include('partials.button',['text' => 'Vedi tutto','black' => true, 'route'=>'categories'])</li>
    </ul>
</div>


<script>
    let isDown = false;
    let startX;
    let scrollLeft;
    const slider = document.querySelector('.promotion-items');

    const end = () => {
        isDown = false;
        slider.classList.remove('active');
    }

    const start = (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX || e.touches[0].pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    }

    const move = (e) => {
        if (!isDown) return;

        e.preventDefault();
        const x = e.pageX || e.touches[0].pageX - slider.offsetLeft;
        const dist = (x - startX) * 1.5;
        slider.scrollLeft = scrollLeft - dist;
    }

    slider.addEventListener('mousedown', start);
    slider.addEventListener('touchstart', start);

    slider.addEventListener('mousemove', move);
    slider.addEventListener('touchmove', move);

    slider.addEventListener('mouseleave', end);
    slider.addEventListener('mouseup', end);
    slider.addEventListener('touchend', end);

</script>


