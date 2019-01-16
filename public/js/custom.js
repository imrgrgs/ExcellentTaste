$('.time').focusout(function (e) {
    let time = $(this).val().split(':');
    if (time[0] > 23 || time[0] < 10 || time[1] > 61 || !$(this).val().includes(':')) {
        $(this).val($(this).attr('data-default'));
    }
});

$('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    startDate: "15-01-2019",
    clearBtn: true,
    language: "nl",
    todayHighlight: true
});
$('.select').select2();