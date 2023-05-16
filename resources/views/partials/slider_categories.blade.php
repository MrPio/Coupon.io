<link rel="stylesheet" href="{{asset('css/partials/slider_categories.css')}}">
{{--<link rel="script" href="{{asset('js/slider.js')}}">--}}

<div class="categories-wrapper">
    <ul class="categories-items" style="gap: 10px">
        @foreach ($categories as $category)
            <li style="justify-content: center" class="categories-item">@include('partials.categoria',
                [
                'id'=>$category->id,
                'title' => $category->title,
                'subtitle' => $category->subtitle,
                'image' => $category->image,
                'color' => $category->color,
                ])
            </li>
        @endforeach
    </ul>
</div>


<script>
    let cat_isDown = false;
    let cat_startX;
    let cat_scrollLeft;
    const cat_slider = document.querySelector('.categories-items');

    const cat_end = () => {
        cat_isDown = false;
        slider.classList.remove('active');
    }

    const cat_start = (e) => {
        cat_isDown = true;
        slider.classList.add('active');
        cat_startX = e.pageX || e.touches[0].pageX - slider.offsetLeft;
        cat_scrollLeft = slider.scrollLeft;
    }

    const cat_move = (e) => {
        if (!cat_isDown) return;

        e.preventDefault();
        const cat_x = e.pageX || e.touches[0].pageX - slider.offsetLeft;
        const cat_dist = (cat_x - cat_startX);
        slider.scrollLeft = cat_scrollLeft - cat_dist;
    }

    (() => {
        slider.addEventListener('mousedown', cat_start);
        slider.addEventListener('touchstart', cat_start);

        slider.addEventListener('mousemove', cat_move);
        slider.addEventListener('touchmove', cat_move);

        slider.addEventListener('mouseleave', cat_end);
        slider.addEventListener('mouseup', cat_end);
        slider.addEventListener('touchend', cat_end);
    })();

</script>



