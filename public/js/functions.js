function sendPostAJAX(options) {
    const {formId, url, data, onSuccess, onError} = options;
    const form = new FormData(document.getElementById(formId));
    $.each(data, (key, value) => form.append(key, value));

    $.ajax({
        type: 'POST',
        url: url,
        data: form,
        dataType: 'json',
        success: onSuccess,
        error: (e) => onError(JSON.parse(e.responseText), e.status),
        contentType: false,
        processData: false
    });
}