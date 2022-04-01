@extends('backend.master')
@section('site-setting_active')
active
@endsection
@section('faq-active')
active
@endsection
@section('Site_setting_active')
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
                    <h1 class="m-0">Faq</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard.index')}}">Home</a></li>
                        <li class="breadcrumb-item active">Faq</li>
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
                <div class="text-right mb-4">

                    <a data-toggle="modal" data-target="#exampleModal" class="btn-sm btn-info">Add Faq</a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Faq Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faqs as $faq)
                        <tr>
                            <td>
                                {{$loop->index+1}}
                            </td>

                            <td>
                                {{$faq->question}}

                            </td>
                            <td>
                                {{$faq->answer}}

                            </td>

                            <td>
                                <a title="Delete Faq" style="padding: 7px 8px"
                                    href="{{route('SiteFaqDelete',$faq->id)}}" class="btn-sm btn-danger"><i
                                        class="fa fa-trash"></i></a>
                            </td>
                            </form>
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
                                <h5 class="modal-title" id="exampleModalLabel">Add Faq</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('SiteFaqCreate')}}" method="POST">
                                    @csrf
                                    <div class="from-group">
                                        <label for="question">Faq Question</label>
                                        <input required name="question" id="question" class="form-control" type="text">
                                    </div>
                                    <div class="from-group">
                                        <label for="answer">Faq Answer</label>
                                        <textarea required name="answer" id="answer" class="form-control"></textarea>
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
    </section>
</div>
@endsection
@section('script_js')
<script>
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