<div class="row ">
    <div class=" mt-5 card-body">
        <h6>Order No: {{$order->order_number}}</h6>
        <article class="card">
            <div class="card-body row">
                <div class="col">
                    <strong>Estimated Order Date:</strong> {{$order->created_at->format('d M Y')}} <br>
                    <strong>Billing User Name:</strong> {{$order->billing_details->billing_user_name}} <br>
                    <strong>Billing Number:</strong> {{$order->billing_details->billing_number}} <br>
                    <strong>Total:</strong>
                    {{$order->subtotal}} <br>
                    <strong>Payment:</strong>
                    {{($order->billing_details->payment_option == 'paid') ? 'Paid' : "Cash On Delivery" }}
                    <br>

                </div>
                @if ($order->delivery_status == 1)

                <div class="col"> <strong>Status:</strong> Pending </div>
                @endif
                @if ($order->delivery_status == 2)

                <div class="col"> <strong>Status:</strong> On the Way </div>
                @endif
                @if ($order->delivery_status == 3)

                <div class="col">
                    <strong>Status:</strong> Deliverd <br>
                    <strong>Delivery date:</strong> {{$order->updated_at->format('d M Y')}} <br>
                </div>
                @endif
            </div>
        </article>
        <div class="track">
            <div
                class="step {{($order->delivery_status == 1 ||$order->delivery_status == 2 || $order->delivery_status == 3 ) ? 'active' : ''}}  ">
                <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Order confirmed</span>
            </div>
            <div class="step {{($order->delivery_status == 2 || $order->delivery_status == 3) ? 'active' : ''}}"> <span
                    class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">
                    On the way </span> </div>
            <div class="step {{($order->delivery_status == 3) ? 'active' : ''}}"> <span class="icon"><i
                        class="fa-solid fa-box"></i></span> <span class="text">Deliverd</span> </div>
        </div>

    </div>
</div>
<div class="row">
    <h5>
        Orderd Product:
    </h5>
    @forelse ($order->order_details as $order_product)
    <div class="col-lg-4 col-12 mt-2">

        <figure class="itemside">
            <div class="aside"><img src="{{asset('thumbnail_img/'.$order_product->Product->thumbnail_img)}}"
                    class="img-sm border">
            </div>
            <figcaption class="info align-self-center">
                <p class="title">{{$order_product->Product->title}}</p>
            </figcaption>
        </figure>
    </div>
    @empty
    @endforelse

</div>