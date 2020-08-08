@if(count($form_components)>0)
    @foreach ($form_components as $key => $form_component)
        @if($form_component_positions[$key]->name=='Bottom')
            @include ('common::backend.component.'.$form_component->file_path)
        @endif
    @endforeach
@endif


{{-- @include ('common::backend.component.images.image-add-edit')
@include ('common::backend.component.files.file-add-edit')
@include ('common::backend.component.videos.video-add-edit') --}}