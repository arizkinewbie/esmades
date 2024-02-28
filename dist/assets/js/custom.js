function templateResult(item, container) {
    // replace the placeholder with the break-tag and put it into an jquery object
    return $('<span>' + item.text
        .replace('<strong>', '<strong>')
        .replace('</strong>', '</strong>')
        .replace('[br]', '<br/>')
        .replace('[br]', '<br/>') + '</span>');
}
function templateSelection(item, container) {
    // replace your placeholder with nothing, so your select shows the whole option text
    // console.log(item.text.match(/<strong>(.*?)<\/strong>/g))
    // var nr = /<strong>(.*?)<\/strong>/g.exec(item.text);
    return item.text
        .replace('<strong>', '')
        .replace('</strong>', '')
        .replace('<br/>', ', ')
        .replace('<br/>', ', ')
        .replace('<br/>', ', ')
        .replace('#', '');
}

$(document).on('change', '.custom-file', function () {
    var file = $('input[type=file]', this)[0].files[0].name;
    $('.custom-file-label',this).text(file);
});

function ajaxSelect(data) {
    if (data) {
        $(data.id).select2({
            multiple: data.multiple ? data.multiple : false,
            templateResult: data.templateResult ? data.templateResult : templateResult,
            templateSelection: data.templateSelection ? data.templateSelection : templateSelection,
            minimumInputLength: data.minimumInputLength ? data.minimumInputLength : null,
            allowClear: data.allowClear ? data.allowClear : null,
            readonly: data.readonly ? data.readonly : null,
            disabled: data.disabled ? data.disabled : null,
            placeholder: data.placeholder ? data.placeholder : 'Pilih Opsi',
            ajax: {
                url: data.url,
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        q: params.term,
                        type: 'public',
                    }

                    let mergedParams = { ...data.optionalSearch, ...query };
                    return mergedParams;
                },
                processResults: function (data) {
                    return {
                        results: data
                    }
                },
                cache: false,
            },
        })

        var selected = data.selected
        if (selected) {
            var dataoption = $(data.id)
            $.ajax({
                url: data.url + '/' + selected,
                dataType: 'json',
                success: function (data) {
                    var option = new Option(data.text, data.id, true, true);
                    dataoption.append(option).trigger('change');
                    dataoption.trigger({
                        type: 'select2:select',
                        params: {
                            data: data
                        }
                    })
                }
            })
        }
    }
}