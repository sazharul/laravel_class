@extends('backend.product.cartlayout')

@section('content')

<div class="row">
    @foreach($products as $product)
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="{{ $product->image }}" alt="">
                <div class="caption">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> {{ $product->price }}$</p>
                    <p class="btn-holder"><a href="javascript:void(0);" class="btn btn-warning btn-block text-center add_to_cart" data-id="{{ $product->id }}"  role="button">Add to cart</a> </p>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection

@section('scripts')
<script>

    // function myFunction(id){
    //     console.log(id);
    // }

    $(document).ready(function(){
        $('.add_to_cart').click(function (){
            let id = $(this).data('id');

            $.ajax({
                type: "GET",
                url: "/admin/add-to-cart/"+id,
                success: function(result){
                    $('.show_cart_count').html(result);
                }
            });


            // $.ajax({
            //     type: "POST",
            //     url: "/admin/add-to-cart/"+id,
            //     data: {
            //         name: name,
            //         id: id,
            //     },
            //     success: function(result){
            //         alert(result.d);
            //         console.log(result);
            //     }
            // });
        });
    });
</script>
@endsection
