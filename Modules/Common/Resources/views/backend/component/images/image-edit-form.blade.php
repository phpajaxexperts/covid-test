<form name="frmImage" id="frmImage">
<div class="card card-outline card-info mb-3">
    <div class="card-header">
      <h3 class="card-title">Edit Image</h3>
      <div class="card-tools">
        <div class="card-body">
            <img src="{{$image_url}}">

              <div class="form-group">
                <label for="image_title" class="col-md-4 control-label">Title</label>
                <div class="col-md-12">
                  <input class="form-control" name="image_title" type="text" id="image_title" value="{{$image_detail->title}}" >
                </div>
              </div>
              <div class="form-group">
              <label for="image_description" class="col-md-4 control-label">Description</label>
              <div class="col-md-12">
                <textarea class="form-control" rows="5" name="image_description" type="textarea" id="image_description" >{{$image_detail->description}}</textarea>
              </div>
              </div>
              <div class="form-group">
              <label for="alt_tag_text" class="col-md-4 control-label">Alt Tag Text</label>
              <div class="col-md-12">
                <input class="form-control" name="alt_tag_text" type="text" id="alt_tag_text" value="{{$image_detail->alt_tag_text}}">
              </div>
              </div>
              <div class="form-group">
                <label for="file" class="col-md-4 control-label">{{ 'Image' }}</label>
                <div class="col-md-12">
                    <input class="form-control" name="image_choice"  checked="checked" type="radio" id="image_choice" value="1" onclick="$('#file').hide();" > Save with existing image
                    <input class="form-control" name="image_choice" type="radio" id="image_choice" value="2" onclick="$('#file').show();"> Update new image
                    <input class="form-control" style="display:none;" name="file" type="file" id="file" >
                </div> 
              </div>
        </div>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    
    <div class="form-group">
      <div class="text-right col-md-12">
            <input class="btn btn-primary" type="submit" value="Save Changes">    
          <input class="form-control" name="key" type="hidden" id="key" value="{{ isset($key) ? $key : ''}}" >
      </div>
    </div>
  </div>
</form>
<script>
 var validator = $("#frmImage").validate({
        //errorContainer: newsletter,
        //meta: "validate",
        rules: {
            image_title: {
                required: true
            }
            /*,file: {
                required: true,
                extension: "jpg|jpeg|git|png"
            }*/
        },
        submitHandler: function(form) {
            var form = $('#frmImage')[0];
            var data = new FormData(form);

            data.append("section", $("#section").val());
            data.append("section_rs", $("#section_rs").val());

            jQuery.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ url('/administrator/update-section-image') }}",
                data: data,
                dataType: "json",
                success: function(msg){
                  getSectionImages(section);
                  swal.fire({text: msg.msg, type: msg.status, showConfirmButton: false, timer: 3000 })
                },
                beforeSend: function() {
                  swal.fire({title: 'Kindly wait while we upload your document...',allowEscapeKey: false,allowOutsideClick: false,customClass: 'logout-popup',onOpen: function() {swal.showLoading();}});
                },
                error: function (xhr, status, error) {
                  swal.close();
                  var obj = jQuery.parseJSON( xhr.responseText );
                   //alert(obj.message);
                   swal.fire({text: obj.message, type: 'warning', showConfirmButton: false, timer: 3000 })
                  var validator = $( "#frmImage" ).validate();
                   $.each( obj.errors, function( key, value) {
                      validator.showErrors({
                        key: value
                      });
									});
                  //alert(" Can't do because: " + error.message);
                },                
            });
          }
      });
</script>