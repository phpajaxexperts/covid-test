<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>Add custom Field</h2></div>
                <div class="card-body">
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form id="frmSectionCustomField" name="frmSectionCustomField" method="POST" action="{{ url('/administrator/store-sectioncustomfield') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('common::backend.sectioncustomfield.form')

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var validator = $("#frmSectionCustomField").validate({
        //errorContainer: newsletter,
        //meta: "validate",
        rules: {
            custom_field: {
                required: true
            }
        },
        submitHandler: function(form) {
            var section = $("#section").val();
            var section_rs = $("#section_rs").val();
            var custom_field = $("#custom_field").val();
            var custom_field_element_label = $("#custom_field_name_preview").html();
            var custom_field_element_preview = $("#custom_field_element_preview").html();
            var param = "custom_field="+custom_field+"&section_rs="+section_rs+"&section="+section+"&custom_field_element_preview="+custom_field_element_preview+"&custom_field_element_label="+custom_field_element_label;
			//var param = $("#frmCategoryCustomField").serialize();
            jQuery.ajax({
                type: "POST",
                url:"{{ url('/administrator/store-sectioncustomfield') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: param,
                success: function(msg){
                    getSectionCustomFields(section);
                    swal.fire({text: msg.msg, type: msg.status, showConfirmButton: false, timer: 3000 })
                }
            });
        }
    });

    function addCategoryCustomField(){
        $.ajax({
        method: "POST",
        url: "{{ url('/administrator/store-sectioncustomfield') }}",
        data: { custom_field: $('#custom_field').val() }
        })
        .done(function( msg ) {
            alert( "Data Saved: " + msg );
        });
    }
</script>