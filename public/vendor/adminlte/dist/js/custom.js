$(document).ready(function(){
    $('#myModal').on('show.bs.modal', function (e) {
        var loadurl = e.relatedTarget.dataset.loadUrl;
        
        var section = '';
        if($('#section').length>0){
            section = $('#section').val();
        }
    
        var section_rs = '';
        if($('#section_rs').length>0){
            section_rs = $('#section_rs').val();
        }

        if (loadurl.indexOf("?") > -1) 
            loadurl = loadurl+'&';
        else
            loadurl = loadurl+'?';
        
        if(section)
        loadurl = loadurl+'section='+section;

        if(section_rs)
        loadurl = loadurl+'&section_rs='+section_rs;


        $('#modal_loading').show();
        $(this).find('.modal-content').load(loadurl, function() {
            $('#modal_loading').hide();
        });
    });

    $(document).ajaxStart(function() { Pace.restart(); });
});

function getCategoryCustomFields(preivew_live){

    var section = '';
    if($('#section').length>0){
        section = $('#section').val();
    }

    var section_rs = '';
    if($('#section_rs').length>0){
        section_rs = $('#section_rs').val();
    }

    jQuery.ajax({
        type: "GET",
        url:baseurl+'/administrator/get-categorycustomfields',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "category="+$('#category').val()+"&module="+$('#module').val()+"&preivew_live="+preivew_live+"&section_rs="+section_rs+"&section="+section,
        success: function(msg){
           if(preivew_live=='preivew_live'){
            
            if(msg.preview==''){
                $('#divCustomFieldsPanel').hide();
            }else{
                $('#divCustomFieldsPanel .overlay').hide();
                $('#divCustomFieldsPanel').show();
                $('#divCustomFields').html(msg.preview);
            }
           }
           else
           $('#categoryCustomFieldPreview').html(msg.preview);
        },
        beforeSend: function(){
            $('#divCustomFieldsPanel .overlay').show();
        }
    });
}

function deleteCategoryCustomField(module,category,key){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.value) {
            jQuery.ajax({
                type: "DELETE",
                url:baseurl+'/administrator/delete-categorycustomfields',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: "module="+module+"&category="+category+"&key="+key,
                success: function(msg){
                    getCategoryCustomFields(module);
                }
            });
        //   Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //   )
        }
      })
}