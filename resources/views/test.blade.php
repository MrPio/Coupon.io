<h1>CIAO</h1>

<form id="form" method="POST" action="{{route('test_post')}}">
    @csrf
    <button id="button">
        CLICK
    </button>
</form>

<script src="{{asset('js/functions.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    $(() => {
        $('#button').click((e) => {
            e.preventDefault();

            sendPostAJAX({
                formId: 'form',
                url: "{{route('test_post')}}",
                data: {'key1': 'val1'},
                onSuccess: () => console.log('onSuccess!'),
                onError: () => console.log('onError!'),
            })
        })
    })
</script>