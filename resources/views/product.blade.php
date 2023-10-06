<!DOCTYPE html>
<html>

<!-- <head>
    <title>Laravel Datatables Yajra Server Side</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset ('admin-assets/dist/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            background-color: #e7e4e4;
        }

        #form {
            background-color: white;
        }

        #form {
            margin-bottom: 5%
        }

        label {
            font-weight: bold;
        }

        .error {
            color: red;
        }
    </style>

</head> -->

<body style="background-color: #e7e4e4;">
    @include('Seller.header')
    <div class="container">
        <br />
        <h3 align="center"><u>Add Product</u></h3>
        <br />
    </div>
    <div class="container">
        <div class="row align-items-left justify-content-left">
            <div class="col-md-5" id="form">
                <form action="" id="ProductForm" name="ProductForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="product_name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="product_name" name="product_name" maxlength="50">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="description" name="description" maxlength="50">
                        </div>
                    </div>
                    <br>
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
                    <br>
                    <div class="form-group" id="subcategory-group">
                        <label for="subcategory_id" class="col-sm-2 control-label">SubCategory</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="subcategory_id" name="subcategory_id">
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group" id="product-type-group">
                        <label for="product_type_id" class="col-sm-2 control-label">Producttype</label>
                        <div class="col-sm-12">
                            <select class="form-control" id="product_type_id" name="product_type_id">
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="images" class="col-sm-2 control-label">Images</label>
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="image" name="images[]" multiple maxlength="50">

                            <img id="imageSrc" src="" style="max-width: 200px;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="price" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="price" name="price" maxlength="50">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exchange_option" class="col-sm-2 control-label">ExchangeOption</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="exchange_option" name="exchange_option" maxlength="50">
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10"><br>
                        <button type="submit" class="btn btn-primary" id="btn-save">Saved</button>
                    </div>
                </form>
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

            $('#category_id').on('change', function() {
                var idCategory = this.value;
                $("#subcategory_id").html('');
                $.ajax({
                    url: "{{ route('api/fetch-subcategory') }}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#subcategory_id').html('<option value="">-- Select Subcategory --</option>');
                        $.each(result.subcategory, function(key, value) {
                            $("#subcategory_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        $('#product_type_id').html('<option value="">-- Select Producttype --</option>');
                    }
                });
            });

            $('#subcategory_id').on('change', function() {
                var idSubcategory = this.value;
                $("#product_type_id").html('');
                $.ajax({
                    url: "{{url('api/fetch-product_type_id')}}",
                    type: "POST",
                    data: {
                        subcategory_id: idSubcategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        console.log(res);
                        $('#product_type_id').html('<option value="">-- Select Producttype --</option>');
                        $.each(res.producttype, function(key, value) {
                            $("#product_type_id").append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
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
                    product_type_id: {
                        required: true,
                        maxlength: 50,
                    },
                    'images[]': {
                        required: true,
                        extension: "jpg|png",
                        accept: "image/jpeg,image/png",
                    },
                    price: {
                        required: true,
                        maxlength: 50,
                    },

                    exchange_option: {
                        required: true,
                        maxlength: 50,
                    }

                },
                messages: {
                    product_name: {
                        required: "Please enter a name.",
                        maxlength: "Name must not exceed 50 characters."
                    },
                    description: {
                        required: "Please enter a description.",
                        maxlength: "Description must not exceed 50 characters."
                    },
                    category_id: {
                        required: "Please select a category."
                    },
                    subcategory_id: {
                        required: "Please select a subcategory."
                    },
                    product_type_id: {
                        required: "Please select a product type."
                    },
                    'images[]': {
                        required: "Please upload a image.",
                    },
                    price: {
                        required: "Please select a price.",
                    },
                    exchange_option: {
                        required: "Please enter an exchange option.",
                        maxlength: "Exchange option must not exceed 50 characters."
                    }
                },

                submitHandler: function(form) {
                    var formData = new FormData(form);
                    let url = "";

                    if ($('#id').val()) {} else {
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
                            document.getElementById('ProductForm').reset();
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
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    @include('Seller.footer')
</body>

