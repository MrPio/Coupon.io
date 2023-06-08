function sendPostAJAX(options) {
    const {only, token, formId, url, data, onSuccess, onError} = options;
    const form = new FormData(document.getElementById(formId));
    if (only != null)
        form.forEach((value, key) => {
            if (key !== only && key !== '_token' && key !== '_method') form.delete(key);
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
        success: onSuccess == null ? null : onSuccess,  // no way, the water is wet
        error: (e) => {
            if (onError != null)
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
        data: {'_token': token, 'data': data},
        dataType: 'json',
        success: onSuccess == null ? null : onSuccess,
        error: (e) => onError == null ? null : onError(JSON.parse(e.responseText), e.status),
    });
}


function doFormValidation(formId, errorsContainer, data) {
    const form = document.getElementById(formId);
    sendPostAJAX({
        formId: formId,
        data: data,
        url: form.getAttribute('action'),
        onSuccess: (data) => {
            window.location.replace(data.redirect)
        },
        onError: (errs, code) => {
            populateErrors(errs, code, errorsContainer)
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
    return out;
}

function doElemValidation(elId, formId, errorsContainer) {
    sendPostAJAX({
        only: elId,
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

function changeSelectablePromotions(url, token) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {
            "company_id": $('[name="company_id"]').val(),
            "_token": token,
            "_method": "POST"
        },
        success: function (response) {
            let promotions = response['promotions'];
            let select_1 = $('[name="promotion_1"]');
            let select_2 = $('[name="promotion_2"]');
            let select_3 = $('[name="promotion_3"]');
            let select_4 = $('[name="promotion_4"]');
            select_1.empty();
            select_2.empty();
            select_3.empty();
            select_4.empty();
            let nullElement_3 = $('<option></option>').attr('value', null).text("");
            let nullElement_4 = $('<option></option>').attr('value', null).text("");
            select_3.append(nullElement_3);
            select_4.append(nullElement_4);
            Object.keys(promotions).forEach(function(key) {
                let optionElement_1 = $('<option></option>').attr('value', key).text(promotions[key]);
                let optionElement_2 = $('<option></option>').attr('value', key).text(promotions[key]);
                let optionElement_3 = $('<option></option>').attr('value', key).text(promotions[key]);
                let optionElement_4 = $('<option></option>').attr('value', key).text(promotions[key]);
                select_1.append(optionElement_1);
                select_2.append(optionElement_2);
                select_3.append(optionElement_3);
                select_4.append(optionElement_4);
            });
        },
        error: function (xhr, status, error) {}
    });
}
