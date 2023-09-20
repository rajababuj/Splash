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
                    <h2>SubCategory List</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onclick="addsubCategory()" href="javascript:void(0)">Create SubCategory</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-bordered" id="subcategory">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>

                </thead>
            </table>
        </div>

    </div>
    <div class="modal fade" id="subcategory-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="SubCategoryModalLabel">Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="SubCategoryForm" name="SubCategoryForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" maxlength="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="category_id" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
            var validator = $('#SubCategoryForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    category_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name.",
                        maxlength: "Name must not exceed 50 characters.",
                    },
                    category_id: {
                        required: "Please select a category.",
                    },

                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    let url = ""
                    if ($('#id').val()) {
                        url = "{{ route('subcategory.update') }}"
                    } else {
                        url = "{{ route('subcategory.store') }}"
                    }

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#subcategory-modal').modal('hide');
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
            $('#subcategory-modal').on('hidden.bs.modal', function() {
                console.log('close');
                validator.resetForm();
                $('#SubCategoryForm').reset();
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#subcategory').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subcategory.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
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

            window.addsubCategory = function() {
                $('#SubCategoryForm').trigger('reset');
                $('#SubCategoryModalLabel').html('Add SubCategory');
                $('#subcategory-modal').modal('show');
                $('#id').val('');
            }
        });

        function editFunc(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('subcategory.edit', ':id') }}".replace(':id', id),
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#SubCategoryModalLabel').html("Edit SubCategory");
                    $('#subcategory-modal').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    if (res.category_id) {
                        $('#category_id').val(res.category_id);
                    }
                }
            });
        }

        function updateFunc(id) {
            var name = $('#name').val();
            $.ajax({
                type: 'post',
                url: "{{ route('subcategory.update', ':id') }}",
                data: {
                    id: id,
                    name: name
                },
                success: function(data) {
                    $('#subcategory-modal').modal('hide');
                    toastr.success('Data Updated successfully.', 'Success');
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("Do you really want to delete record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "DELETE",
                    url: "subcategory/destroy/" + id,
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#subcategory').DataTable();
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
</body>

@endsection