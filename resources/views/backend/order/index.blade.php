@extends('backend.master')
@section('order_active')
active
@endsection

@section('content')

<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Orders</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <div class="card-body table-responsive p-0">
                    <table id="myTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Order Date</th>
                                <th>Delivery Status </th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                            <tr>
                                <td>{{$order->order_number}}</td>
                                <td>{{$order->created_at->format('d-M-Y')}}</td>
                                <td>
                                    @if ($order->delivery_status == 1)
                                    <a href="{{route('DeliveryStatus',$order->id)}}" class="btn-sm btn-danger">pending</a>
                                    @elseif ($order->delivery_status == 2)
                                    <a href="{{route('DeliveryStatus',$order->id)}}" class="btn-sm btn-warning">On The way</a>
                                    @else
                                    <a class="btn-sm btn-success">Deliverd</a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn-sm btn-primary" href="{{route('OrderDetails',$order->id)}}">Details</a>
                                    <a class="btn-sm btn-success" href="{{route('InvoiceDownload',$order->id)}}"><i
                                            class="fa fa-download"></i></a>
                                </td>
                            </tr>
                            @empty
                            <td class="text-center" colspan="10">No Record</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>
@endsection
@section('script_js')
<script>
    $(document).ready(function() {
    $('#myTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 
        ]
    } );
} );

    @if (session('delete')) 
Command: toastr["error"]("{{session('delete')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
@if (session('success')) 
Command: toastr["success"]("{{session('success')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif
@if (session('warning')) 
Command: toastr["warning"]("{{session('warning')}}")

toastr.options = {
  "closeButton": false,
  "debug": false,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-right",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "5000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
@endif

</script>
@endsection