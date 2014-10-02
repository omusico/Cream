$(document).ready(function()
{

    $('.sortable').sortable({
            handle : 'i',
            update : function(event, ui)
            {
                var info = $(this).sortable("serialize");

                $.ajax({
                    type:   "PUT",
                    url:    'http://' + window.location.host + '/config/actiontypes/reorder',
                    data:   info,
                    
                });
            }
        }
    );

});