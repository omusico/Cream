$(document).ready(function() {

    $('.task_way_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 3,
        minView: 2,
        maxView: 3,
        pickerPosition: 'bottom-left',
        forceParse: 0
        // showMeridian: 1
    });

    $('.event_way_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 3,
        minView: 0,
        maxView: 3,
        pickerPosition: 'bottom-left',
        forceParse: 0
        // showMeridian: 1
    });

});