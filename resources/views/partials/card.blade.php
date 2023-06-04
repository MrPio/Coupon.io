@props([
    'image'=>'amazon.png',
    'color'=>'#ffffff',
    'route'=>null,
    'company_id'=>'',
    'editable'=>false,
])

<link rel="stylesheet" href="{{asset('css/partials/card.css')}}">

<div class="card--azienda hover_animation shadow"
     @if(isset($route)) onclick="window.location='{{$route}}'" @endif
     style="background-color: {{$color}};">
    <div class="card--image"
            {{--style="background-image: url(../../images/aziende/{{$image}});"--}}>
        <img src="{{asset('images/aziende/'.$image)}}">
    </div>

    @if($editable)
        <div id="card--edit_{{$company_id}}" class="card--edit shadow ripple">
            <img src="{{asset('images/edit.svg')}}">
        </div>
        <div id="card--destroy_{{$company_id}}" class="card--destroy shadow ripple">
            <img src="{{asset('images/bin.svg')}}">
        </div>
    @endif
</div>

<script>
    $(() => {
        @if($editable)
        $('#card--edit_{{$company_id}}')
            .on('click', (e) => {
                e.stopPropagation()
                window.location = '{{route('aziende.edit',$company_id)}}'
            })
        $('#card--destroy_{{$company_id}}')
            .on('click', (e) => {
                e.stopPropagation()
                if (confirm('Sei sicuro di voler rimuovere l\'azienda {{ $company_id }}?')) {
                    sendDeleteAJAX({
                        url: "{{ route('aziende.destroy', $company_id) }}",
                        token: '{{ csrf_token() }}',
                        onSuccess: () => window.location.href = '{{ route('aziende.index') }}'
                    });
                }
            })
        @endif
    })
</script>

