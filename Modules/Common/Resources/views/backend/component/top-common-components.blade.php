@if(count($form_components)>0)
    @foreach ($form_components as $key => $form_component)
        @if($form_component_positions[$key]->name=='Top')
            @include ('common::backend.component.'.$form_component->file_path)
            @if($form_component->name == 'Category')
                @include('common::backend.component.category.cmp-category-custom-fields')
            @endif
        @endif
    @endforeach
@endif