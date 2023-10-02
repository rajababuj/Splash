<div>
    @include('Seller.header')
    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
        <div class="product-section">
            <div class="container">
                <div class="row" style="justify-content: center; ">
                    @foreach($roles as $im)

                    <div class="col-6" style="margin: 0px">
                        <a class="product-im" href="{{ route('user.productoffer', $im->id) }}">
                            <img style="height: 100px; width:200px" src="{{$im->fromProduct->image[0]}}" class="img-fluid">
                            <P><b>{{ $im->fromProduct->product_name }}</b></P>
                            <p><b>${{ $im->fromProduct->price }}</b></p>
                            <P><b>${{ $im->fromProduct->description }}</b></P>

                        </a>
                    </div>

                    <div class="col-6" style="margin: 0px">
                        <a class="product-im" href="{{ route('user.productoffer', $im->id) }}">
                            <img style="height: 100px; width:200px" src="{{$im->toProduct->image[0]}}" class="img-fluid">
                            <P><b>{{ $im->toProduct->product_name }}</b></P>
                            <p><b>${{ $im->toProduct->price }}</b></p>
                            <P><b>${{ $im->toProduct->description }}</b></P>
                        </a>
                    </div>
                    <a href="{{ route('user.home') }}" class="btn btn-light" data-id="{{ $im->id }}">{{ $im->status }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
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
                    <button type="submit" class="btn btn-success acceptButton" data-id="{{ $item->id }}">Accept</button>
                    <a type="submit" class="btn btn-danger rejectButton" data-id="{{ $item->id }}">Reject</a>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".acceptButton, .rejectButton").click(function(e) {
            e.preventDefault();

            var itemId = $(this).data("id");
            var status = $(this).hasClass('acceptButton') ? 'accept' : 'reject';

            $.ajax({
                type: "POST",
                url: "{{ route('accept.reject.swap', ['id' => ':id']) }}".replace(':id', itemId),
                data: {
                    _token: "{{ csrf_token() }}",
                    status: status
                },
                success: function(data) {
                    if (data.success) {
                        toastr.success(data.message);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("An error occurred: " + error);
                },
            });
        });
    });
</script>


@include('Seller.footer')