<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($category->name) ? $category->name : ''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('caption') ? 'has-error' : ''}}">
    <label for="caption" class="col-md-4 control-label">{{ 'Caption' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="caption" type="text" id="caption" value="{{ isset($category->caption) ? $category->caption : ''}}" >
        {!! $errors->first('caption', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label for="description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="description" type="textarea" id="description" >{{ isset($category->description) ? $category->description : ''}}</textarea>
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Image' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image" value="{{ isset($category->image) ? $category->image : ''}}" >
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('video_url') ? 'has-error' : ''}}">
    <label for="video_url" class="col-md-4 control-label">{{ 'Video Url' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="video_url" type="text" id="video_url" value="{{ isset($category->video_url) ? $category->video_url : ''}}" >
        {!! $errors->first('video_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('gallery_url') ? 'has-error' : ''}}">
    <label for="gallery_url" class="col-md-4 control-label">{{ 'Gallery Url' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="gallery_url" type="text" id="gallery_url" value="{{ isset($category->gallery_url) ? $category->gallery_url : ''}}" >
        {!! $errors->first('gallery_url', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('meta_title') ? 'has-error' : ''}}">
    <label for="meta_title" class="col-md-4 control-label">{{ 'Meta Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="meta_title" type="text" id="meta_title" value="{{ isset($category->meta_title) ? $category->meta_title : ''}}" >
        {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('meta_description') ? 'has-error' : ''}}">
    <label for="meta_description" class="col-md-4 control-label">{{ 'Meta Description' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="meta_description" type="textarea" id="meta_description" >{{ isset($category->meta_description) ? $category->meta_description : ''}}</textarea>
        {!! $errors->first('meta_description', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('meta_keywords') ? 'has-error' : ''}}">
    <label for="meta_keywords" class="col-md-4 control-label">{{ 'Meta Keywords' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="meta_keywords" type="textarea" id="meta_keywords" >{{ isset($category->meta_keywords) ? $category->meta_keywords : ''}}</textarea>
        {!! $errors->first('meta_keywords', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('active') ? 'has-error' : ''}}">
    <label for="active" class="col-md-4 control-label">{{ 'Active' }}</label>
    <div class="col-md-6">
        <select name="active" class="form-control" id="active" >
    @foreach (json_decode('{"1":"yes","0":"no"}', true) as $optionKey => $optionValue)
        <option value="{{ $optionKey }}" {{ (isset($category->active) && $category->active == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
    @endforeach
</select>
        {!! $errors->first('active', '<p class="help-block">:message</p>') !!}
    </div>
</div>