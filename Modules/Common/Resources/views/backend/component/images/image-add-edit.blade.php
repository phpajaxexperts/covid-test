@push('js')
<script type="text/x-tmpl" id="tmpl-image-grid">
{% for (var i=0; i<o.images.length; i++) { %}
<div class="col-sm-3">
    <div class="item"><img src="{%=o.images[i].image_url%}" class="img-thumbnail"></div>
    <div class="text-center mt-2 mb-4">
      <a href="#" data-load-url="{{ url('administrator/edit-image') }}?key={%=o.images[i].key%}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-success btn-xs">edit</button>
      </a>
      <a href="#" data-load-url="{{ url('administrator/delete-image-confirm') }}?key={%=o.images[i].key%}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-danger btn-xs">delete</button>
      </a>
    </div>
</div>
{% } %}
</script>

<script>
  function getSectionImages(){
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
        url:baseurl+'/administrator/get-section-images',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "section_rs="+section_rs+"&section="+section,
        success: function(data){
                $('#divImagesPanel .overlay').hide();
                $('#divImages').html(tmpl('tmpl-image-grid', data));
                //document.getElementById('divImages').innerHTML = tmpl('tmpl-images-grid', data);
        },
        beforeSend: function(){
            $('#myModal').modal('hide');
            $('#divImagesPanel .overlay').show();
        }
    });
  }

  function editImage(key){
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
        url:baseurl+'/administrator/get-section-image',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "section_rs="+section_rs+"&section="+section+"&key="+key,
        success: function(msg){
                $('#divImagesPanel .overlay').hide();
                $('#myModal').find('.modal-content').html(msg);
                $('#myModal').modal('show');
        },
        beforeSend: function(){
            $('#myModal').modal('hide');
            $('#divImagesPanel .overlay').show();
        }
    });
  }
  
  function deleteImage(key){
    Swal.fire({
        title: 'Are you sure, want delete the image?',
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
                url:baseurl+'/administrator/delete-image',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: "section_rs="+$('#section_rs').val()+"&section="+$('#section').val()+"&key="+key,
                success: function(msg){
                  getSectionImages();
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

<div class="card card-outline card-info mb-3" id="divImagesPanel">
    <div class="card-header">
      <h3 class="card-title">Images</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <a href="#" data-load-url="{{ url('administrator/add-image-form') }}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> add images</button>
      </a>
      <br />
      <br />    
      <div class="container">
        <div class="row" id="divImages">
          @isset($section_images)
            @if(count($section_images)>0)
              @foreach ($section_images as $image)
              <div class="col-sm-3">
              <div class="item"><img src="{{$image_paths['img_path']}}/{{$image->image}}{{$img_optimize_params}}" class="img-thumbnail"></div>
                <div class="text-center mt-2 mb-4">
                  <a href="#" data-load-url="{{ url('administrator/edit-image') }}?key={{$image->ID}}" data-toggle="modal" data-target="#myModal">
                    <button class="btn btn-success btn-xs">edit</button>
                  </a>
                  <a href="#" data-load-url="{{ url('administrator/delete-image-confirm') }}?key={{$image->ID}}" data-toggle="modal" data-target="#myModal">
                    <button class="btn btn-danger btn-xs">delete</button>
                  </a>
                </div>
            </div>
              @endforeach
            @endif
          @endisset
        </div>
    </div>
    </div>
    <div class="overlay" style="display: none;">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i> 
    </div>
</div>