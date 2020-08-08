<form name="frmVideo" id="frmVideo">
  <div class="card card-outline card-info mb-3">
          <div class="card-header">
            <h3 class="card-title">Video Details</h3>
            <div class="card-tools">
              <!-- Buttons, labels, and many other things can be placed here! -->
              <!-- Here is a label for example -->
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
        <div class="card-body">
          <div class="form-group">
            <label for="video_type" class="col-md-4 control-label">{{ 'Video Type' }}</label>
            <div class="col-md-12">
                @php
                 $video_types = getCoreVideoType();
                @endphp
                {{ Form::select('video_type', $video_types, isset($video_detail->type) ? $video_detail->type : '' , ['id' => 'video_type', 'class' => 'form-control','placeholder' => ' - select video - ']) }}
                {!! $errors->first('video_title', '<p class="help-block">:message</p>') !!}
            </div>
          </div>

          <div class="form-group">
              <label for="video_title" class="col-md-4 control-label">{{ 'Video Title' }}</label>
              <div class="col-md-12">
                  <input class="form-control" name="video_title" type="text" id="video_title" value="{{ isset($video_detail->title) ? $video_detail->title : ''}}" >
                  {!! $errors->first('video_title', '<p class="help-block">:message</p>') !!}
              </div>
          </div>
          <div class="form-group">
            <label for="video_description" class="col-md-4 control-label">{{ 'Video Description' }}</label>
            <div class="col-md-12">
                <textarea class="form-control" rows="5" name="video_description" type="textarea" id="video_description" >{{ isset($video_detail->description) ? $video_detail->description : ''}}</textarea>
                {!! $errors->first('Video Description', '<p class="help-block">:message</p>') !!}
            </div>
          </div>
            <div class="form-group">
              <label for="video_link" class="col-md-4 control-label">{{ 'Video Link' }}</label>
              <div class="col-md-12">
                  <input class="form-control" name="video_url" type="text" id="video_url" value="{{ isset($video_detail->video_url) ? $video_detail->video_url : ''}}" >
                  {!! $errors->first('video_link', '<p class="help-block">:message</p>') !!}
              </div>
            </div>
        </div>
        
        <div class="form-group">
          <div class="text-right col-md-12">
              <input class="btn btn-primary" type="submit" value="Add Video">
              <input class="form-control" name="key" type="hidden" id="key" value="{{ isset($key) ? $key : ''}}" >
          </div>
        </div>
          {{-- <div class="overlay">
            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
          </div> --}}
      </div>
</form>

<script type="text/javascript">
  var validator = $("#frmVideo").validate({
          //errorContainer: newsletter,
          //meta: "validate",
          rules: {
              video_title: {
                  required: true
              },
              video_url: {
                  required: true
              }
          },
          submitHandler: function(form) {
              var section = $("#section").val();
              var section_rs = $("#section_rs").val();
              var key = $("#key").val();
              var video_type = $("#video_type").val();
              var video_title = $("#video_title").val();
              var video_description = $("#video_description").val();
              var video_url = $("#video_url").val();
              var param ="section_rs="+section_rs+"&section="+section+"&video_type="+video_type+"&video_title="+video_title+"&video_description="+video_description+"&video_url="+video_url+"&key="+key;
              //var param = $("#frmCategoryCustomField").serialize();
              jQuery.ajax({
                  type: "POST",
                  url:"{{ url('/administrator/store-section-video') }}",
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  data: param,
                  success: function(msg){
                      getSectionVideos(section);
                      swal.fire({text: msg.msg, type: msg.status, showConfirmButton: false, timer: 3000 })
                  }
              });
          }
      });

   
  </script>

