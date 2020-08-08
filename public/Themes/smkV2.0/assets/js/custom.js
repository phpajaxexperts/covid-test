$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var loadurl = e.relatedTarget.dataset.loadUrl;
        $(this).find('.modal-content').html();
        $('#modal_loading').show();
        $(this).find('.modal-content').load(loadurl, function() {
            $('#modal_loading').hide();
        });
    });

    $(document).ajaxStart(function() { Pace.restart(); });
});
