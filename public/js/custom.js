$('.time').focusout(function (e) {
    let time = $(this).val().split(':');
    if (time[0] > 23 || time[0] < 10 || time[1] > 61 || !$(this).val().includes(':') || $(this).val().length > 5) {
        $(this).val($(this).attr('data-default'));
    }
});

$('.datepicker').datepicker({
    format: "dd-mm-yyyy",
    startDate: Date.now().toString(),
    clearBtn: true,
    language: "nl",
    todayHighlight: true,
    todayBtn: "linked"
});

$('a[data-toggle="modal"]').on('click', function () {
    $.get($(this).attr('href'), $(this).attr('data-options')).then(function (res) {
        $('#app').append(res);
        $('#modal').modal('toggle').on('hidden.bs.modal', function (e) {
            $(this).remove();
        })
    });
    return false;
});

$('.select').select2();

function resetSwitches() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switcheroo'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html);
    });
}

function getSwitchedTables()
{
    $.get('/tables/excluded', {
        start_date: $('#start_date').val(),
        start_time: $('#start_time').val(),
        end_date: $('#end_date').val(),
        end_time: $('#end_time').val()
    }).then(function (res) {
        $('input:checkbox').prop('checked', false);
        $.each(res, function (id) {
            $('#' + res[id] + ' > input').prop('checked', true);
        });
        $('.switchery').remove();
        resetSwitches();
    })
}

resetSwitches();