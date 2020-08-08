@push('js')
<script type="text/x-tmpl" id="tmpl-file-grid">
{% for (var i=0; i<o.files.length; i++) { %}
<div class="col-sm-2">
    <div class="item"><img src="{{ asset('images/icons/{%=o.files[i].type_name.icon%}_128.png') }} " class="img-thumbnail"></div>
    <div class="text-center  mt-2 mb-3">
      {%=o.files[i].title%}<br>
      <a href="#" data-load-url="{{url('administrator/edit-file?key={%=o.files[i].key%}') }}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-success btn-xs"> edit </button>
      </a>
      <button type="button" class="btn btn-danger btn-xs" title="Delete File" onclick="return deleteFile('{%=o.files[i].key%}')"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</button>
    </div>
</div>
{% } %}
</script>
<script>
  function getSectionFiles(){
    var section = '';
    if($('#section').length>0){
        section = $('#section').val();
    }

    var section_rs = '';
    if($('#section_rs').length>0){
        section_rs = $('#section_rs').val();
    }

    jQuery.ajax({
        type: "POST",
        url:baseurl+'/administrator/get-section-files',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "section_rs="+section_rs+"&section="+section,
        success: function(data){
                $('#divFilesPanel .overlay').hide();
                $('#divFiles').html(tmpl('tmpl-file-grid', data));
                //$('#divFiles').html(msg.file);
        },
        beforeSend: function(){
            $('#myModal').modal('hide');
            $('#divFilesPanel .overlay').show();
        }
    });
  }

  function editFile(key){
    var section = '';
    if($('#section').length>0){
        section = $('#section').val();
    }

    var section_rs = '';
    if($('#section_rs').length>0){
        section_rs = $('#section_rs').val();
    }

    jQuery.ajax({
        type: "POST",
        url:baseurl+'/administrator/get-section-file',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "section_rs="+section_rs+"&section="+section+"&key="+key,
        success: function(msg){
                $('#divFilesPanel .overlay').hide();
                $('#myModal').find('.modal-content').html(msg);
                $('#myModal').modal('show');
        },
        beforeSend: function(){
            $('#myModal').modal('hide');
            $('#divFilesPanel .overlay').show();
        }
    });
  }
  
  function deleteFile(key){
    Swal.fire({
        title: 'Are you sure, want delete the file?',
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
                url:baseurl+'/administrator/delete-file',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: "section_rs="+$('#section_rs').val()+"&section="+$('#section').val()+"&key="+key,
                success: function(msg){
                  getSectionFiles(module);
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
</script>    
@endpush

<div class="card card-outline card-info mb-3" id="divFilesPanel">
    <div class="card-header">
      <h3 class="card-title">Files</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <a href="#" data-load-url="{{ url('administrator/add-file-form') }}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> add a file</button>
      </a>
      <br />
      <br />    
      <div class="row" id="divFiles">
      @if(isset($section_files))
        @if(count($section_files)>0)
          @foreach($section_files as $key => $section_file)
            <div class="col-sm-2">
              <div class="item"><img src="{{ asset('images/icons/'.$section_file->typeName->icon.'_128.png') }}" class="img-thumbnail"></div>
              <div class="text-center mt-2 mb-4">
                {{$section_file->title}}<br>
                <a href="#" data-load-url="{{url('administrator/edit-file?key='.$section_file->ID) }}" data-toggle="modal" data-target="#myModal">
                  <button class="btn btn-success btn-xs"> edit </button>
                </a>
                <button type="button" class="btn btn-danger btn-xs" title="Delete File" onclick="return deleteFile({{$section_file->ID}})"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</button>
              </div>
            </div>
          @endforeach
        @endif
      @endif
      </div>
    </div>
    <div class="overlay" style="display:none;">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div>
</div>
