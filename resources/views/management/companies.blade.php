{{--
@extends('layouts.management')

@section('title', 'Aziende')

@section('content')
    <div class="content-container">
        <div class="item-container">
            @foreach($companies as $company)
                <?php
                    $company_class_name = str_replace(' ', '_', $company->name);
                    $is_removed = isset($company->removed_at);
                    $fade_class = '';
                    if ($is_removed) {
                        $fade_class = 'fade-row';
                    }
                ?>
                <div id="company-{{ $company_class_name }}" class="company-row {{ $fade_class }}">
                    <div class="left-container">
                        <div class="image-container" style="background-color: {{ $company->color }}">
                            <img class="company-logo item-image-fixed-width" src="{{ asset('images/aziende/' . $company->logo) }}" alt="logo dell'azienda {{ $company->name }}">
                        </div>
                        <div class="company-info">
                            <table>
                                <tr>
                                    <td>Nome:</td>
                                    <td class="company-name">{{ $company->name }}</td>
                                </tr>
                                <tr>
                                    <td>Tipo:</td>
                                    <td>{{ $company->type }}</td>
                                </tr>
                                <tr>
                                    <td>Luogo:</td>
                                    <td>{{ $company->place }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    @if(!$is_removed)
                    <div id="right-container-{{ $company_class_name }}" class="right-container">
                        <div class="edit-object center-content">
                            <div class="button-container edit-button-container center-content">
                                <a href={{ route('aziende.edit', [$company]) }}>
                                    <svg viewBox="0 0 512 512" width="40.37" height="38.4"><path d="M290.74 93.24l128.02 128.02-277.99 277.99-114.14 12.6C11.35 513.54-1.56 500.62.14 485.34l12.7-114.22 277.9-277.88zm207.2-19.06l-60.11-60.11c-18.75-18.75-49.16-18.75-67.91 0l-56.55 56.55 128.02 128.02 56.55-56.55c18.75-18.76 18.75-49.16 0-67.91z"></path></svg>
                                </a>
                            </div>
                        </div>
                        <div class="delete-object center-content">
                            <form action="{{ route('aziende.destroy', $company->id) }}" method="POST" onsubmit="deleteCompany(this, '{{ $company->name }}')">
                                @csrf
                                @method('DELETE')
                                <div class="button-container delete-button-container center-content">
                                    <button type="submit" style="background-color: rgb(0, 0, 0, 0); border: none">
                                        <svg viewBox="64 64 896 896" width="43.74" height="41.6"><path d="M864 256H736v-80c0-35.3-28.7-64-64-64H352c-35.3 0-64 28.7-64 64v80H160c-17.7 0-32 14.3-32 32v32c0 4.4 3.6 8 8 8h60.4l24.7 523c1.6 34.1 29.8 61 63.9 61h454c34.2 0 62.3-26.8 63.9-61l24.7-523H888c4.4 0 8-3.6 8-8v-32c0-17.7-14.3-32-32-32zm-200 0H360v-72h304v72z"></path></svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
--}}
{{--        TODO: far anche vedere quanti item ci stanno --}}{{--

        <div class="man-pagination">
            <?php
                $current_page = $companies->currentPage();
                $last_page = $companies->lastPage();
            ?>
            <div class="first-page">
                <a href="{{ $companies->url(1) }}">Inizio</a>
            </div>
            <div class="previous-page">
                <a href="#">
                    <svg class="svg-change-page" width="48" height="48" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg>
                </a>
            </div>
            <div class="current-page">
                @csrf
                --}}
{{-- TODO: non so quale azione mettere alla form; forse non ci va messa --}}{{--

                <form method="GET">
                    <input type="text" name="page" id="page" pattern="[0-9]*" inputmode="numeric" value="{{ $current_page }}" required>
                </form>
            </div>
            <div class="next-page">
                <a>
                    <svg class="svg-change-page" width="48" height="48" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg>
                </a>
            </div>
            <div class="last-page">
                <a href="{{ $companies->url($last_page) }}">Fine: {{ $last_page }}</a>
            </div>
        </div>
    </div>
    <script>

        function deleteCompany(formElement, companyName){
            event.preventDefault();
            let companyClassName = companyName.replace(/ /g, "_");
            if (confirm('Sei sicuro di voler rimuovere l\'azienda ' + companyName + '?')) {
                sendDeleteAJAX({
                    url: $(formElement).attr('action'),
                    token: '{{ csrf_token() }}',
                    onSuccess: function() {
                        // add fade class - remove buttons
                        $('#company-' + companyClassName).addClass('fade-row');
                        $('#right-container-' + companyClassName).remove();
                        Swal.fire({
                            title: 'Operazione andata a buon fine!',
                            text: 'L\'azienda ' + companyName + ' è stata rimossa con successo!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                    }
                });
            }
        }

        let current_page = {{ $current_page }};
        let last_page = {{ $last_page }};
        jQuery('img.company-logo').each(function () {
            this.onload = function() {
                if (this.naturalHeight > this.naturalWidth) {
                    this.classList.add('item-image-fixed-height');
                    this.classList.remove('item-image-fixed-width');
                }
            };
        });
        jQuery('input#page').on('focus', function () {
           $(this).val('');
        });
        let next_page = jQuery('.next-page a');
        if (current_page + 1 > last_page) {
            next_page.attr('href', '#')
        } else {
            next_page.attr('href', '{{ $companies->url($current_page + 1) }}');
        }
        let previous_page = jQuery('.previous-page a');
        if (current_page <= 1) {
            previous_page.attr('href', '#');
        } else {
            previous_page.attr('href', '{{ $companies->url($current_page - 1) }}');
        }
    </script>
@endsection
--}}
