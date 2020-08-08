@push('js')
<script type="text/x-tmpl" id="tmpl-video-grid">
{% for (var i=0; i<o.videos.length; i++) { %}
<div class="col-sm-3">
  <div class="item"><img src="{%=o.videos[i].video_thumb_url%}" class="img-thumbnail"></div>
    <div class="text-center mt-2 mb-4">
      {%=o.videos[i].title%}<br>
      <a href="#" data-load-url="{{url('administrator/edit-video?key={%=o.videos[i].key%}') }}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-success btn-xs"> edit </button>
      </a>
      <button type="button" class="btn btn-danger btn-xs" title="Delete File" onclick="return deleteVideo('{%=o.videos[i].key%}')"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</button>
    </div>
  </div>
{% } %}
</script>


<script>
  function getSectionVideos(){
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
        url:baseurl+'/administrator/get-section-videos',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "section_rs="+section_rs+"&section="+section,
        success: function(data){
                $('#divVideosPanel .overlay').hide();
                $('#divVideos').html(tmpl('tmpl-video-grid', data));
                //$('#divVideos').html(msg.video);
        },
        beforeSend: function(){
            $('#myModal').modal('hide');
            $('#divVideosPanel .overlay').show();
        }
    });
  }

  function editVideo(key){
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
        url:baseurl+'/administrator/get-section-video',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: "section_rs="+section_rs+"&section="+section+"&key="+key,
        success: function(msg){
                $('#divVideosPanel .overlay').hide();
                $('#myModal').find('.modal-content').html(msg);
                $('#myModal').modal('show');
        },
        beforeSend: function(){
            $('#myModal').modal('hide');
            $('#divVideosPanel .overlay').show();
        }
    });
  }
  
  function deleteVideo(key){
    Swal.fire({
        title: 'Are you sure, want delete the video?',
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
                url:baseurl+'/administrator/delete-video',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: "section_rs="+$('#section_rs').val()+"&section="+$('#section').val()+"&key="+key,
                success: function(msg){
                  getSectionVideos(module);
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

<div class="card card-outline card-info mb-3" id="divVideosPanel">
    <div class="card-header">
      <h3 class="card-title">Videos</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <a href="#" data-load-url="{{ url('administrator/add-video-form') }}" data-toggle="modal" data-target="#myModal">
        <button class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> add a video</button>
      </a>
      <br />
      <br />
      <div class="row" id="divVideos">
      @if(isset($section_videos))
        @if(count($section_videos)>0)
          @foreach($section_videos as $key => $section_video)
            @php
              $video_thumb_url = getVideoThumbUrl($section_video->video_url,$section_video->type);   
            @endphp
              <div class="col-sm-3">
              <div class="item"><img src="{{$video_thumb_url}}" class="img-thumbnail"></div>
                <div class="text-center mt-2 mb-4">
                  {{$section_video->title}}<br>
                  <a href="#" data-load-url="{{url('administrator/edit-video?key='.$section_video->ID) }}" data-toggle="modal" data-target="#myModal">
                    <button class="btn btn-success btn-xs"> edit </button>
                  </a>
                  <button type="button" class="btn btn-danger btn-xs" title="Delete File" onclick="return deleteVideo({{$section_video->ID}})"><i class="fa fa-trash-o" aria-hidden="true"></i> delete</button>
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