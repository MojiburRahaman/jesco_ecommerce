
@foreach ($orders as $order)
<tr>
    <td>{{'#' .$order->order_number}}</td>
    <td>{{$order->created_at->format("M d,Y")}}</td>
    <td> {{'৳'.$order->subtotal}} for {{$order->order__details_count}} item </td>
    @if ($order->delivery_status == 1)
    <td><span class="success">Pending</span></td>
    @elseif ($order->delivery_status == 2)
    <td><span class="success">On The Way</span></td>
    @else
    <td><span class="success">Deliverd</span></td>
    @endif

</tr>
@endforeach