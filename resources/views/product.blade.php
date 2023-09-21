<!DOCTYPE html>
<html>

<head>
    <title>Laravel Datatables Yajra Server Side</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    @include('Seller.header')
    <div class="container">
        <br />
        <h3 align="center">Product table</h3>
        <br />
        <div align="right">
            <button type="button" name="add" id="add_data" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#product-modal">
                <i class="bi bi-plus-square"></i> Add
            </button>
        </div>
        <br />
        <table id="product_table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Category </th>
                    <th>Subcategory </th>
                    <th>Product Type</th>
                    <th>Image</th>
                    <th>Exchange Option</th>
                    <th>Action</th>
                    <th>
                        <button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs"><i class="bi bi-backspace-reverse-fill"></i></button>
                    </th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade" id="product-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ProductModalLabel">Product</h5>
                    <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="ProductForm" name="ProductForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="name" name="product_name" maxlength="50">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="description" name="description" maxlength="50">
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
                        <div class="form-group">
                            <label for="product_type_id" class="col-sm-2 control-label">Product</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="product_type_id" name="product_type_id">
                                    <option value="">Select Product</option>
                                    @foreach($product_types as $product_type)
                                    <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <img id="imageSrc" src="" style="max-width: 200px;" />
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="exchange_option" class="col-sm-2 control-label">Exchange Option</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="exchange_option" name="exchange_option" maxlength="50">
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

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            var table = $('#product_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'category_id',
                        name: 'category_id'
                    },
                    {
                        data: 'subcategory_id',
                        name: 'subcategory_id'
                    },
                    {
                        data: 'product_type_id',
                        name: 'product_type_id'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'exchange_option',
                        name: 'exchange_option'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#ProductForm').validate({
                rules: {
                    product_name: {
                        required: true,
                        maxlength: 50,

                    },
                    description: {
                        required: true,
                        maxlength: 50,
                    },
                    category_id: {
                        required: true,
                        maxlength: 50,
                    },
                    subcategory_id: {
                        required: true,
                        maxlength: 50,
                    },
                    product_type: {
                        required: true,
                        maxlength: 50,
                    },
                    image: {
                        required: true,
                        extension: "jpg|png"
                    },

                    exchange_option: {
                        required: true,
                        maxlength: 50,
                    }
                },

                submitHandler: function(form) {
                    var formData = new FormData(form);
                    let url = "";

                    if ($('#id').val()) {
                        url = "{{ route('product.update') }}";
                    } else {
                        url = "{{ route('product.store') }}";
                    }

                    $.ajax({
                        type: 'POST',
                        url: url,
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            $('#product-modal').modal('hide');
                            // Reload the DataTable
                            table.ajax.reload();
                            var successMessage = $('#id').val() ? 'Data Updated successfully.' : 'Data Added successfully.';
                            toastr.success(successMessage, 'Success');;
                        },
                        // error: function(data) {
                        //     if (data.status === 422) {
                        //         var response = JSON.parse(data.responseText);
                        //         toastr.error(response.error, 'Error');
                        //     } else {
                        //         console.log(data);
                        //     }
                        // }
                    });
                }
            });
            window.addProduct = function() {
                $('#ProductForm').trigger('reset');
                $('#ProductModalLabel').html('Add Product');
                $('#product-modal').modal('show');
                $('#id').val('');
            };


        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    @include('Seller.footer')
</body>

</html>