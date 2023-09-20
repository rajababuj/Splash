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
                    <h2>Product_Type List</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" onclick="addproducttype()" href="javascript:void(0)">Create ProductType</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="prodcuttype">
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
    <div class="modal fade" id="producttype-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ProductTypeModalLabel">Product_Type</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="Product_typeForm" name="Product_typeForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="name" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subcategory_id" class="col-sm-2 control-label">SubCategory</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="subcategory_id" name="subcategory_id">
                                    <option value="">Select SubCategory</option>
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
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
           var validator = $('#Product_typeForm').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 50,
                    },
                    subcategory_id: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name.",
                        maxlength: "Name must not exceed 50 characters.",
                    },
                    subcategory_id: {
                        required: "Please select a subcategory.",
                    },
                },
                submitHandler: function(form) {
                    var formData = new FormData(form);
                    let url = ""
                    if ($('#id').val()) {
                        url = "{{ route('Producttype.update') }}"
                    } else {
                        url = "{{ route('Producttype.store') }}"
                    }

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#producttype-modal').modal('hide');
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
            $('#producttype-modal').on('hidden.bs.modal', function() {
                // console.log('close');
                validator.resetForm();
                $('#Product_typeForm').reset();
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#prodcuttype').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('Producttype.index') }}",
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

            window.addproducttype = function() {
                $('#Product_typeForm').trigger('reset');
                $('#ProductTypeModalLabel').html('Add Product_Type');
                $('#producttype-modal').modal('show');
                $('#id').val('');
            }

        });

        function editFunc(id) {
            $.ajax({
                type: "GET",
                url: "{{ route('Producttype.edit', ':id') }}".replace(':id', id),
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                    $('#ProductTypeModalLabel').html("Edit Category");
                    $('#producttype-modal').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    if (res.subcategory_id) {
                        $('#subcategory_id').val(res.subcategory_id);
                    }
                }
            });
        }

        function updateFunc(id) {
            var name = $('#name').val();

            $.ajax({
                type: 'post',
                url: "{{ route('Producttype.update', ':id') }}",
                data: {
                    id: id,
                    name: name
                },
                success: function(data) {
                    $('#producttype-modal').modal('hide');
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
                    url: "Producttype/destroy/" + id,
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#Producttype').DataTable();
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