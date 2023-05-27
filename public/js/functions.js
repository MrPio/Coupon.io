function sendPostAJAX(options) {
    const {formId, url, data, onSuccess, onError} = options;
    const form = new FormData(document.getElementById(formId));
    if (data != null)
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


function doFormValidation(formId, errorsContainer) {
    sendPostAJAX({
        formId: formId,
        url: document.getElementById(formId).getAttribute('action'),
        onSuccess: (data) => window.location.replace(data.redirect),
        onError: (errs, code) => {
            if (code === 422) {
                const container = $('#' + errorsContainer);
                container.find('.errors').html(' ');
                $.each(errs, (id) => {
                    const el=$('[name="'+id+'"]')
                    el.removeClass('error')
                    el.addClass('error')
                    container.append(getErrorHtml(errs[id]));
                });
            }
        },
    })
}


function getErrorHtml(elemErrors) {
    if ((typeof (elemErrors) === 'undefined') || (elemErrors.length < 1))
        return;
    let out = '<ul class="errors">';
    for (let i = 0; i < elemErrors.length; i++) {
        out += '<li>' + elemErrors[i] + '</li>';
    }
    out += '</ul>';
    console.log(out)
    return out;
}
