$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('button.ajax, input[type="button"].ajax, input[type="submit"].ajax').on('click touchstart', function(e) {
        var form = $(this).parent();
        var data = {};
        form.find('textarea, input, select').each(function() {
            if ($(this).attr('name')) {
                data[$(this).attr('name')] = $(this).is('textarea') ? $(this).text() : $(this).val();
            }
        });
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: data
        }).done(function(r) {
            console.log(r);
        }).fail(function() {
            console.log("error");
        });
        e.preventDefault();
        return false;
    });
});