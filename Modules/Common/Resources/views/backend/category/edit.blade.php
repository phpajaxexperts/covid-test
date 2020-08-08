@extends('layouts.master')

@section('content')
<form method="POST" action="{{ url('/administrator/update-category/' .$module .'/'. $category->ID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Category #{{ $category->ID }}</div>
                    <div class="card-body">
                        <a href="{{ url('/administrator/view-category/'.$module) }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            @include ('common::backend.category.form', ['submitButtonText' => 'Update'])

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Custom Fields</div>
                    <div class="card-body">
                        <a href="#" data-load-url="{{ url('administrator/create-categorycustomfield') }}" data-toggle="modal" data-target="#myModal">
                            <button class="btn btn-warning btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> add a custom field</button>
                        </a>
                        <br />
                        <br />
                        <div id="categoryCustomFieldPreview">
                            @if(count($category_custom_fields)>0)
                                @foreach($category_custom_fields as $key => $category_custom_field)
                                    <div class="form-group">
                                    <label for="custom_field" class="col-md-4 control-label">{{$category_custom_field->name}} 
                                    <button type="button" class="btn btn-danger btn-sm" title="Delete Sectioncustomfield" onclick="return deleteCategoryCustomField('{{$module}}','{{$category_custom_field->category}}','{{$category_custom_field->category_custom_field_id}}')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    </label>
                                    <div class="col-md-12">
                                        @php
                                            $custom_field_element = generateInputElement($category_custom_field->typeName->ID,$category_custom_field->name,$category_custom_field->fieldValues);
                                            //$custom_field_element = '';
                                        @endphp            
                                        <? echo $custom_field_element;?>
                                    </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-4 col-md-4">
            <input class="btn btn-primary" type="submit" value="{{ isset($submitButtonText) ?  $submitButtonText : 'Create' }}">
            <input type="hidden" name="category" id="category" value="{{ isset($category->ID)?$category->ID:'' }}">
            <input type="hidden" name="module" id="module" value="{{ isset($module)?$module:'' }}">
            <input type="hidden" name="parent" id="parent" value="{{isset($parent)?$parent:''}}">
        </div>
    </div>
</form>
@endsection
