<form name="frmFile" id="frmFile">
  <div class="card card-outline card-info mb-3">
          <div class="card-header">
            <h3 class="card-title">File Details</h3>
            <div class="card-tools">
              <div class="card-body">
                <div class="form-group">
                    <label for="file_title" class="col-md-4 control-label">{{ 'Title' }}</label>
                    <div class="col-md-12">
                        <input class="form-control" name="file_title" type="text" id="file_title" value="{{ isset($file_detail->title) ? $file_detail->title : ''}}" >
                        {!! $errors->first('file_title', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
                <div class="form-group">
                  <label for="file_description" class="col-md-4 control-label">{{ 'Description' }}</label>
                  <div class="col-md-12">
                      <textarea class="form-control" rows="5" name="file_description" type="textarea" id="file_description" >{{ isset($file_detail->description) ? $file_detail->description : ''}}</textarea>
                      {!! $errors->first('File Description', '<p class="help-block">:message</p>') !!}
                  </div>
                </div>
                @isset($key)
                  <div class="form-group">
                    <label for="file" class="col-md-4 control-label">{{ 'File' }}</label>
                    <div class="col-md-12">
                        {{ isset($file_detail->file) ? $file_detail->file : ''}}<br><br>
                        <input class="form-control" name="file_choice"  checked="checked" type="radio" id="file_choice" value="1" onclick="$('#file').hide();" > Save with existing file
                        <input class="form-control" name="file_choice" type="radio" id="file_choice" value="2" onclick="$('#file').show();"> Update new file
                        <input class="form-control" style="display:none;" name="file" type="file" id="file" >
                        {!! $errors->first('file_name', '<p class="help-block">:message</p>') !!}
                    </div> 
                  </div>
                @else
                  <div class="form-group">
                    <label for="file" class="col-md-4 control-label">{{ 'File' }}</label>
                    <div class="col-md-12">
                        <input class="form-control" name="file" type="file" id="file" value="{{ isset($file_detail->file_name) ? $file_detail->file_name : ''}}" >
                        {!! $errors->first('file_name', '<p class="help-block">:message</p>') !!}
                    </div>
                  </div>
                @endisset
              </div>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
        
        
        <div class="form-group">
          <div class="text-right col-md-12">
              @isset($key)
                <input class="btn btn-primary" type="submit" value="Save Changes">    
              @else
                <input class="btn btn-primary" type="submit" value="Add File">
              @endisset
              
              <input class="form-control" name="key" type="hidden" id="key" value="{{ isset($key) ? $key : ''}}" >
          </div>
        </div>
      </div>
</form>

<script type="text/javascript">
  var validator = $("#frmFile").validate({
        //errorContainer: newsletter,
        //meta: "validate",
        rules: {
            file_title: {
                required: true
            }
            ,file: {
                required: true,
                extension: "doc|docx|pdf|xls|xlsx"
            }
        },
        submitHandler: function(form) {
            var form = $('#frmFile')[0];
            var data = new FormData(form);

            data.append("section", $("#section").val());
            data.append("section_rs", $("#section_rs").val());
            //data.append("key", $("#key").val());
            //data.append("file_title", $("#file_title").val());
            //data.append("file_description", $("#file_description").val());

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
                url:"{{ url('/administrator/store-section-file') }}",
                data: data,
                dataType: "json",
                success: function(msg){
                  getSectionFiles(section);
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
                  var validator = $( "#frmFile" ).validate();
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