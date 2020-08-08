<form name="frmDeleteImage" id="frmDeleteImage">
<div class="card card-outline card-info mb-3">
    <div class="card-header">
      <h3 class="card-title">Delete Image</h3>
      <div class="card-tools">
        <div class="card-body">
          Are you sure, want to delete following image? <br><br>
            <img src="{{$image_url}}"><br>
            {{$image_detail->title}}
        </div>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    
    <div class="form-group">
      <div class="text-right col-md-12">
            <input class="btn btn-primary" type="button" value="Cancel" onclick="$('#myModal').modal('hide');">
            <input class="btn btn-primary" type="submit" value="Delete">    
            <input class="form-control" name="key" type="hidden" id="key" value="{{ isset($key) ? $key : ''}}" >
      </div>
    </div>
  </div>
</form>
<script>
 var validator = $("#frmDeleteImage").validate({
        submitHandler: function(form) {
          var section = '';
          if($('#section').length>0){
              section = $('#section').val();
          }

          var section_rs = '';
          if($('#section_rs').length>0){
              section_rs = $('#section_rs').val();
          }

          var key = $('#key').val();

          jQuery.ajax({
              type: "DELETE",
              url:baseurl+'/administrator/delete-image',
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: "section_rs="+section_rs+"&section="+section+"&key="+key,
              success: function(msg){
                      $('#divImagesPanel .overlay').hide();
                      getSectionImages();
              },
              beforeSend: function(){
                  $('#myModal').modal('hide');
                  $('#divImagesPanel .overlay').show();
              }
          });
        }
  });
</script>