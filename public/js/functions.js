function sendPostAJAX(options) {
    const {only, token, formId, url, data, onSuccess, onError} = options;
    const form = new FormData(document.getElementById(formId));
    if (only != null)
        form.forEach((value, key) => {
            if (key !== only) form.delete(key);
        })
    if (token != null)
        form.append('_token', token)
    if (data != null)
        $.each(data, (key, value) => form.append(key, value));

    $.ajax({
        type: 'POST',
        url: url,
        data: form,
        dataType: 'json',
        success: onSuccess == null ? null : onSuccess,
        error: (e) => {
            if(onError != null)
                onError(JSON.parse(e.responseText), e.status)
        },
        contentType: false,
        processData: false
    });
}

function sendDeleteAJAX(options) {
    const {url, token, onSuccess, onError} = options;
    $.ajax({
        type: 'DELETE',
        url: url,
        data: {'_token': token,},
        dataType: 'json',
        success: onSuccess == null ? null : onSuccess,
        error: (e) => onError == null ? null : onError(JSON.parse(e.responseText), e.status),
    });
}


function sendGetAJAX(options) {
    const {url, token, onSuccess, onError, data} = options;
    $.ajax({
        type: 'GET',
        url: url,
        data: {'_token': token, 'data': data },
        dataType: 'json',
        success: onSuccess == null ? null : onSuccess,
        error: (e) => onError == null ? null : onError(JSON.parse(e.responseText), e.status),
    });
}



function doFormValidation(formId, errorsContainer, data) {
    const form = document.getElementById(formId);

    sendPostAJAX({
        formId: formId,
        data:data,
        url: form.getAttribute('action'),
        onSuccess: (data) => {
            window.location.replace(data.redirect)
        },
        onError: (errs, code) => populateErrors(errs, code, errorsContainer),
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
    return out;
}

function doElemValidation(elId, formId, errorsContainer) {
    sendPostAJAX({
        only: elId,
        token: $("#" + formId + " input[name='_token']").val(),
        formId: formId,
        url: document.getElementById(formId).getAttribute('action'),
        onError: (errs, code) => populateErrors(errs, code, errorsContainer, elId),
    })
}

function populateErrors(errs, code, errorsContainer, only) {
    if (code === 422) {
        const container = $('#' + errorsContainer);
        container.find('.errors').html(' ');
        $.each(errs, (id) => {
            if (only == null || only === id) {
                const el = $('[name="' + id + '"]')
                el.removeClass('error')
                el.addClass('error')
                container.append(getErrorHtml(errs[id]));
            }
        });
    }
}
