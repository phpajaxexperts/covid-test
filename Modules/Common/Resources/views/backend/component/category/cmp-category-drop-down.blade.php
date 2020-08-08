@push('js')
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2();
    if($('#category').val()!='')
    getCategoryCustomFields('preivew_live');
});
</script>
@endpush

<div class="card card-outline card-info mb-3">
    <div class="card-header">
      <h3 class="card-title">Category</h3>
      <div class="card-tools">
        <!-- Buttons, labels, and many other things can be placed here! -->
        <!-- Here is a label for example -->
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      @php
       $categories_dropdown = getCategoriesDropDown($module,'0','0',isset($selected_category)?$selected_category:'');
      @endphp
      <select id="category" name="category" class="required js-example-basic-single form-control" name="state" onchange="getCategoryCustomFields('preivew_live');">
        <option value=""> - select category - </option>
        <?php echo $categories_dropdown; ?>
      </select>
    </div>
</div>

