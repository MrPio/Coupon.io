<style>
    #base{
        width: 100%;
        height: 400px;
        border-radius: 26px;
        background-color: var(--color5);
        display: grid;
        grid-template-rows: 50% 50%;
        overflow: hidden;
    }
    #base:active{
        background-color: var(--color4);
    }
    #content{
        padding: 40px 30px;
        display: grid;
        grid-template-rows: 50% 50%;
    }
</style>

<div id="base">
    <div id="content">
        <h2>{{$title}}</h2>
        <h4>{{$subtitle}}</h4>
    </div>
    <img src="{{asset('images/'.$image_file)}}" alt="">
</div>