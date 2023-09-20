@extends('Admin.main-layout')
@section('content-header')
@endsection
@section('body')
<!DOCTYPE html>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Category List</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onclick="addCategory()" href="javascript:void(0)">Create Category</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="category">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="modal fade" id="category-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="CategoryModalLabel">Category</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="CategoryForm" name="CategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" maxlength="50">
                            </div>
                        </div>

                        <label for="image" class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="image" name="image" maxlength="50">
                            <img id="imageSrc" src="" style="max-width: 200px;" />
                        </div>
                        <div class="col-sm-offset-2 col-sm-10"><br>
                            <button type="submit" class="btn btn-primary" id="btn-save">Saved</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {

            var validator = $('#CategoryForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                        lettersOnly: true
                    },
                    image: {
                        required: true,
                        extension: "jpg|png"
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name.",
                        maxlength: "Name must not exceed 50 characters.",
                        lettersOnly: "Name must contain alphabets only."
                    },
                    image: {
                        required: "Please upload the image.",
                        maxlength: "Name must not exceed 50 characters.",
                    }
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    let url = ""
                    if ($('#id').val()) {
                        url = "{{ route('category.update') }}"
                    } else {
                        url = "{{ route('category.store') }}"
                    }
                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#category-modal').modal('hide');
                            table.ajax.reload();
                            var successMessage = $('#id').val() ? 'Data Updated successfully.' : 'Data Added successfully.';
                            toastr.success(successMessage, 'Success');;
                        },
                        error: function(data) {
                            if (data.status === 422) {
                                var response = JSON.parse(data.responseText);
                                toastr.error(response.error, 'Error');
                            } else {
                                console.log(data);
                            }
                        }
                    });
                }
            });
            $('#category-modal').on('hidden.bs.modal', function() {
                // console.log('close');
                validator.resetForm();
                $('#CategoryForm').reset();
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.validator.addMethod("lettersOnly", function(value, element) {
                return this.optional(element) || /^[a-zA-Z\s]+$/i.test(value);
            }, "Name must contain alphabets only.");
            var table = $('#category').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('category.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        render: function(data, type, full, meta) {
                            console.log(data);
                            return '<img src= "' + data + '" + alt="" width="100" height="100">';
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'desc']
                ]
            });
            window.addCategory = function() {
                $('#CategoryForm').trigger('reset');
                $('#CategoryModalLabel').html('Add Category');
                $('#category-modal').modal('show');
                $('#id').val('');
                $('#imageSrc').attr('src', '');
                $('#imageSrc').hide();
            };
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</body>
<script>
    function editFunc(id) {
        $.ajax({
            type: "GET",
            url: "{{ route('category.edit', ':id') }}".replace(':id', id),
            dataType: 'json',
            success: function(res) {
                console.log(res);
                $('#CategoryModalLabel').html("Edit Category");
                $('#category-modal').modal('show');
                $('#id').val(res.id);
                $('#name').val(res.name);
                $('#image_name').val(res.image);
                if (res.image) {
                    $('#imageSrc').attr('src', res.image);
                    $('#imageSrc').show();
                } else {
                    $('#imageSrc').attr('src', '');
                    $('#imageSrc').hide();
                }
            }
        });
    }
</script>
<script>
    function updateFunc(id) {
        var name = $('#name').val();

        $.ajax({
            type: 'post',
            url: "{{ route('category.update', ':id') }}",
            data: {
                id: id,
                name: name
            },
            success: function(data) {
                $('#category-modal').modal('hide');
                toastr.success('Data Updated successfully.', 'Success');
            },
            error: function(data) {
                console.log(data);
            }
        });
    }
</script>
<script>
    function deleteFunc(id) {
        if (confirm("Do you really want to delete record?") == true) {
            var id = id;
            $.ajax({
                type: "DELETE",
                url: "category/destroy/" + id,
                dataType: 'json',
                success: function(res) {
                    var oTable = $('#category').DataTable();
                    oTable.ajax.reload(null, false);
                    toastr.success('Record deleted successfully.', 'Success');
                },
                error: function(res) {
                    console.log(res);
                }
            });
        }
    }
</script>
@endsection