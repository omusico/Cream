$(document).ready(function() {

    $('.form_date').datetimepicker({
        language:  'es',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 3,
        minView: 2,
        maxView: 4,
        pickerPosition: 'bottom-left',
        forceParse: 0
        // showMeridian: 1
    });

});