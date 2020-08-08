
  <div class="card card-outline card-info mb-3">
    <div class="card-header">
      <h3 class="card-title">Image Upload</h3>
      <div class="card-tools">
        <div class="card-body">

        <form id="fileupload_modal" action="{{ url('/administrator/upload-section-images') }}" method="POST" enctype="multipart/form-data">
            
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row col-lg-7 fileupload-buttonbar">
          <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span id="btnUploadImages" class="btn btn-success fileinput-button text-center">
              <i class="glyphicon glyphicon-plus"></i>
              <span>Upload Images</span>
              <input type="file" name="files[]" multiple />
            </span>
            {{-- <button type="submit" class="btn btn-primary start">
              <i class="glyphicon glyphicon-upload"></i>
              <span>Start upload</span>
            </button> --}}
            {{-- <button type="reset" class="btn btn-warning cancel">
              <i class="glyphicon glyphicon-ban-circle"></i>
              <span>Cancel upload</span>
            </button> --}}
            {{-- <button type="button" class="btn btn-danger delete">
              <i class="glyphicon glyphicon-trash"></i>
              <span>Delete selected</span>
            </button> --}}
            {{-- <input type="checkbox" class="toggle" /> --}}
            <!-- The global file processing state -->
            <span class="fileupload-process"></span>
          </div>
          <!-- The global progress state -->
          <div class="col-lg-5 fileupload-progress fade">
            <!-- The global progress bar -->
            <div
              class="progress progress-striped active"
              role="progressbar"
              aria-valuemin="0"
              aria-valuemax="100"
            >
              <div
                class="progress-bar progress-bar-success"
                style="width: 0%;"
              ></div>
            </div>
            <!-- The extended global progress state -->
            <div class="progress-extended">&nbsp;</div>
          </div>
        </div>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped" style="opacity:1;" >
          <tbody class="files"></tbody>
        </table>
          
      <div class="row fileupload-buttonbar">
      <button id="btnStartUpload" type="submit" class="btn btn-primary start" style="display:none;">
        <i class="glyphicon glyphicon-upload"></i>
        <span>Start upload</span>
      </button>
      </div>
      </form>

        </div>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    
    <div class="form-group" style="display: none;">
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

<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-upload">
          <td>
              <span class="preview"></span>
          </td>
          <td>
              <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
          </td>
          <td>
              <div class="form-group">
                <label for="image_title" class="col-md-4 control-label">Title</label>
                <div class="col-md-12">
                  <input class="form-control" name="image_title" type="text" id="image_title"  >
                </div>
              </div>
              <div class="form-group">
              <label for="image_description" class="col-md-4 control-label">Description</label>
              <div class="col-md-12">
                <textarea class="form-control" rows="5" name="image_description" type="textarea" id="image_description" ></textarea>
              </div>
              </div>
              <div class="form-group">
              <label for="alt_tag_text" class="col-md-4 control-label">Alt Tag Text</label>
              <div class="col-md-12">
                <input class="form-control" name="alt_tag_text" type="text" id="alt_tag_text" value="" >
              </div>
              </div>
          </td>
      </tr>
  {% } %}

</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
  {% for (var i=0, file; file=o.files[i]; i++) { %}
      <tr class="template-download fade">
          <td>
              <span class="preview">
                  {% if (file.thumbnailUrl) { %}
                      <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                  {% } %}
              </span>
          </td>
          <td>
              {% if (window.innerWidth > 480 || !file.thumbnailUrl) { %}
                  <p class="name">
                      {% if (file.url) { %}
                          <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                      {% } else { %}
                          <span>{%=file.name%}</span>
                      {% } %}
                  </p>
              {% } %}
              {% if (file.error) { %}
                  <div><span class="label label-danger">Error</span> {%=file.error%}</div>
              {% } %}
          </td>
          <td>
              <span class="size">{%=o.formatFileSize(file.size)%}</span>
          </td>
          <td>
              {% if (file.deleteUrl) { %}
                  <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                      <i class="glyphicon glyphicon-trash"></i>
                      <span>Delete</span>
                  </button>
                  <input type="checkbox" name="delete" value="1" class="toggle">
              {% } else { %}
                  <button class="btn btn-warning cancel">
                      <i class="glyphicon glyphicon-ban-circle"></i>
                      <span>Cancel</span>
                  </button>
              {% } %}
          </td>
      </tr>
  {% } %}
</script>

<link rel="stylesheet" href="{{ asset('node_modules/blueimp-file-upload/css/jquery.fileupload.css') }}" />
<link rel="stylesheet" href="{{ asset('node_modules/blueimp-file-upload/css/jquery.fileupload-ui.css') }}" />

<script src="{{ asset('node_modules/blueimp-file-upload/js/vendor/jquery.ui.widget.js') }}"></script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="{{ asset('node_modules/blueimp-load-image/js/load-image.all.min.js') }}"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="{{ asset('node_modules/blueimp-canvas-to-blob/js/canvas-to-blob.min.js') }}"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
{{-- <script src="js/jquery.iframe-transport.js"></script> --}}
<!-- The basic File Upload plugin -->
<script src="{{ asset('node_modules/blueimp-file-upload/js/jquery.fileupload.js') }}"></script>
<!-- The File Upload processing plugin -->
<script src="{{ asset('node_modules/blueimp-file-upload/js/jquery.fileupload-process.js') }}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{ asset('node_modules/blueimp-file-upload/js/jquery.fileupload-image.js') }}"></script>
<!-- The File Upload validation plugin -->
<script src="{{ asset('node_modules/blueimp-file-upload/js/jquery.fileupload-validate.js') }}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{ asset('node_modules/blueimp-file-upload/js/jquery.fileupload-ui.js') }}"></script>

<script type="text/javascript">
$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } });
$(function () {
    'use strict';
		// Initialize the jQuery File Upload widget:
		$('#fileupload_modal').fileupload({
			// Uncomment the following to send cross-domain cookies:
			xhrFields: {withCredentials: true},
			//url: '{{url("listings/upload-image")}}',
			url: "{{url('administrator/upload-section-images')}}",
			acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
		}).on('fileuploadadd', function (e, data) {
        $('#btnStartUpload').show();
        $('#btnUploadImages').hide();

        $("#btnStartUpload").on('click', function () {
           $('#modal_loading').show();
            data.submit();
        });
    })
    .on('fileuploadsubmit', function (e, data) {
      var inputs = data.context.find(':input');
      if (inputs.filter(function () {
              return !this.value && $(this).prop('required');
          }).first().focus().length) {
          data.context.find('button').prop('disabled', false);
          return false;
      }
      data.formData = inputs.serializeArray();
			data.formData.push({name: 'section', value: $("#section").val()});
      data.formData.push({name: 'section_rs', value: $("#section_rs").val()});
    });
    // .on('fileuploadcompleted', function (e, data) {
    //     alert("Hai");
    // });

		$('#fileupload_modal').bind('fileuploadcompleted', function (e, data) {
			getSectionImages();
			$('#myModal').modal('hide');
      $('#btnStartUpload').button('reset');
		});
   
		
	});

var validator = $("#fileupload_modal").validate();

  </script>