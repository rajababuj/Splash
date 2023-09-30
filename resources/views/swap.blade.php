<div>
    @include('Seller.header')
    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
        <div class="product-section">
            <div class="container">
                <div class="row" style="justify-content: center; ">
                    @foreach($check as $item)

                    <div class="col-6" style="margin: 0px">
                        <a class="product-item" href="{{ route('user.productoffer', $item->id) }}">
                            <img style="height: 100px; width:200px" src="{{$item->fromProduct->image[0]}}" class="img-fluid">
                            <P><b>{{ $item->fromProduct->product_name }}</b></P>
                            <p><b>${{ $item->fromProduct->price }}</b></p>
                            <P><b>${{ $item->fromProduct->description }}</b></P>

                        </a>
                    </div>

                    <div class="col-6" style="margin: 0px">
                        <a class="product-item" href="{{ route('user.productoffer', $item->id) }}">
                            <img style="height: 100px; width:200px" src="{{$item->toProduct->image[0]}}" class="img-fluid">
                            <P><b>{{ $item->toProduct->product_name }}</b></P>
                            <p><b>${{ $item->toProduct->price }}</b></p>
                            <P><b>${{ $item->toProduct->description }}</b></P>
                        </a>
                    </div>
                    @if($item->to_users_id == Auth::id())
                    <a href="{{ route('user.home') }}" class="btn btn-success" data-id="{{ $item->id }}">Accept</a>
                    @endif

                    <a href="#" class="btn btn-danger rejectButton" data-id="{{ $item->id }}">Reject</a>


                    @endforeach
                </div>
            </div>
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
        $(".rejectButton").on("click", function(e) {
            e.preventDefault();

            var itemId = $(this).data("id");

            $.ajax({
                url: "{{ route('remove.data', '') }}/" + itemId,
                type: "DELETE",
                dataType: "json",
                success: function(response) {
                    $(e.target).closest(".product-item").remove();

                    toastr.success('Product swapped successfully.', 'Success');
                    setTimeout(function() {

                    }, 30);
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.responseText);
                }
            });
        });
    });
</script>

@include('Seller.footer')