$('.time').focusout(function (e) {
    let time = $(this).val().split(':');
    if (time[0] > 23 || time[0] < 10 || time[1] > 61 || !$(this).val().includes(':') || $(this).val().length > 5 || !$.isNumeric(time[0])) {
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

$('.date-range').daterangepicker({
    "locale": {
        "format": 'YYYY/MM/DD',
        "daysOfWeek": [
            "Zo",
            "Ma",
            "Di",
            "Wo",
            "Do",
            "Vr",
            "Za"
        ],
        "monthNames": [
            "Januari",
            "Februari",
            "Maart",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Augustus",
            "September",
            "Oktober",
            "November",
            "December"
        ],
    },
    ranges: {
        'Vandaag': [moment(), moment()],
        'Gister': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Afgelopen 7 dagen': [moment().subtract(6, 'days'), moment()],
        'Afgelopen 30 dagen': [moment().subtract(29, 'days'), moment()],
        'Deze Maand': [moment().startOf('month'), moment().endOf('month')],
        'Vorige Maand': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
});

$('.select').select2();

function resetSwitches() {
    var elems = Array.prototype.slice.call(document.querySelectorAll('.switcheroo'));
    elems.forEach(function (html) {
        var switchery = new Switchery(html, {
            color: '#d40100',
            secondaryColor: '#64bd63'
        });
    });
}

function getExcludedTables() {
    let options = {
        start_date: $('#date').val(),
        start_time: $('#start_time').val(),
        withReservations: true
    };
    if ($('#end_time').length) {
        options = {
            start_date: $('#date').val(),
            start_time: $('#start_time').val(),
            end_time: $('#end_time').val(),
            withReservations: true
        };
    }
    $.get('/tables/excluded', options).then(function (res) {
        $('#tables option').prop('disabled', false);
        $.each(res, function (id) {
            $('#table_' + res[id]).attr('disabled', true);
        });
    })
}

function getSwitchedTables() {
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