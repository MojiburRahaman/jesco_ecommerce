@extends('backend.master')
@section('site-setting_active')
active
@endsection
@section('banner-active')
active
@endsection
@section('color-Site_setting_active')
menu-open
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Main content -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Banner</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Banner</li>
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

                <div class="text-right">

                    <a data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-info">Add Banner</a>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>offer</th>
                                <th>heading</th>
                                <th>banner image</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $banner)

                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$banner->offer}}</td>
                                <td>{{$banner->heading}}</td>
                                <td><img src="{{asset('banner_image/'.$banner->banner_image)}}" width="20%" alt=""></td>
                                <td>{{$banner->created_at->diffForHumans()}}</td>
                                <td>
                                    @if ($banner->status == 1)
                                    <a href="{{route('SiteBannerStatus',$banner->id)}}"
                                        class="btn-sm btn-primary">Active</a>
                                    @else
                                    <a href="{{route('SiteBannerStatus',$banner->id)}}"
                                        class="btn-sm btn-warning">Inactive</a>
                                    @endif
                                    <a href="{{route('SiteBannerDelete',$banner->id)}}"
                                        class="ml-2 btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <td class="text-center" colspan="10">No Data Available</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('SiteBannerPost')}}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="from-group">
                                            <label for="">Heading</label>
                                            <input required name="heading" class="form-control" type="text">
                                        </div>
                                        <div class="from-group">
                                            <label for="">Offer</label>
                                            <input name="offer" class="form-control" type="text">
                                        </div>
                                        <div class="from-group">
                                            <label for="">Banner Image</label>
                                            <input required name="banner_image" class="form-control" type="file">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Save </button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
    $('.product_id').select2();
});



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