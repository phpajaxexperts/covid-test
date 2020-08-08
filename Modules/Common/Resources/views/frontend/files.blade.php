@isset($files)
@if(count($files)>0)
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Files</div>
            <div class="card-body">
                <div class="row">
                @isset($files)
                    @if(count($files)>0)
                    @foreach ($files as $file)
                        @php( $file_folder_url = fileUrlGenerator( array('file_folder' => config($file->module_config_name.".".$file->collection_name.".files") ) ) )
                        <div class="col-sm-2">
                            <a target="_blank" href="{{ url($file_folder_url.'/'.$section_rs_ID.'/'.$file->file) }}">
                                <div class="item"><img src="{{ asset('images/icons/'.config('trivpro.file_types.'.$file->type.'.icon').'_128.png') }}" class="img-thumbnail"></div>
                                <div class="text-center mt-2 mb-4">
                                    {{$file->title}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                    @endif
                @endisset
                </div>    
            </div>
        </div>
    </div>
</div>
@endif
@endisset