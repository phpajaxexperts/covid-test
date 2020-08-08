<div class="card card-outline card-info mb-3">
    <div class="card-header">
      <h3 class="card-title">Meta Details</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
    <div class="form-group>
        <label for="meta_title" class="col-md-4 control-label">{{ 'Meta Title' }}</label>
        <div class="col-md-6">
            <input class="form-control" name="meta_title" type="text" id="meta_title" value="{{ isset($meta_detail->meta_title) ? $meta_detail->meta_title : ''}}" >
            {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
        <label for="meta_keywords" class="col-md-4 control-label">{{ 'Meta Keywords' }}</label>
        <div class="col-md-6">
            <textarea class="form-control" rows="5" name="meta_keywords" type="textarea" id="meta_keywords" >{{ isset($meta_detail->meta_keywords) ? $meta_detail->meta_keywords : ''}}</textarea>
            {!! $errors->first('Meta Keywords', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group">
      <label for="meta_description" class="col-md-4 control-label">{{ 'Meta Description' }}</label>
      <div class="col-md-6">
          <textarea class="form-control" rows="5" name="meta_description" type="textarea" id="meta_description" >{{ isset($meta_detail->meta_description) ? $meta_detail->meta_description : ''}}</textarea>
          {!! $errors->first('Meta Description', '<p class="help-block">:message</p>') !!}
      </div>
  </div>
   
    </div>
    {{-- <div class="overlay">
      <i class="fas fa-2x fa-sync-alt fa-spin"></i>
    </div> --}}
</div>
