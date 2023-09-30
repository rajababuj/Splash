<!doctype html>
<html lang="en">

<body>
   @include('Seller.header')
    <div class="blog-section" >
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4 mb-5">
                    @foreach($category as $item)
                    <div class="post-entry">
                       <h4 class="product-title" style="margin-left: 10px;">{{ $item->name }}</h4>
                       <div class="space-container"></div>
                        <a href="#" class="post-thumbnail" style="display: flex; align-items: center;">
                            <img src="{{$item->image}}" class="img-fluid product-thumbnail" style="width: 100px; height: 100px;" alt="{{ $item->id }}">
                        </a>
                       
                        <button class="add-interest-button" data-interest-id="{{ $item->id }}">Add Interest</button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.add-interest-button').click(function() {
                var interestId = $(this).data('interest-id');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.add-interest') }}",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'interest_id': interestId
                    },
                    success: function(response) {
                        console.log(response); 
                        alert(response.message);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText); 
                        alert('Error adding interest.');
                    }
                });

            });
        });
    </script>
    @include('Seller.footer')


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>