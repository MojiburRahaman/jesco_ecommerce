@extends('backend.master')

@section('blog_dropdown_active')
menu-open
@endsection
@section('blog_active')
active
@endsection
@section('view_blog-active')
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
                    <h1 class="m-0">Blogs</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
        <div class="col-12">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>thumbnail</th>
                            <th>Created At</th>
                            {{-- @if (auth()->user()->can('Delete Color') || auth()->user()->can('Edit Color')) --}}

                            <th>Action</th>
                            {{-- @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)

                        <tr>
                            <td>
                                {{$loop->index+1}}
                            </td>
                            <td>{{$blog->title}}</td>
                            <td>
                                <img width="80px" src="{{asset('blog/thumbnail/'.$blog->blog_thumbnail)}}" alt="">
                            </td>
                            <td>{{$blog->created_at->diffForHumans()}}</td>
                            {{-- @if (auth()->user()->can('Delete Color') || auth()->user()->can('Edit Color')) --}}
                            <form action="{{route('blogs.destroy',$blog->id)}}" method="post">
                                <td>
                                    {{-- @can('Edit Color') --}}

                                    <a style="padding: 7px 8px" href="{{route('blogs.edit',$blog->id)}}"
                                        class="btn-sm btn-primary">Edit</a>
                                    {{-- @endcan --}}
                                    @csrf
                                    {{-- @can('Delete Color') --}}
                                    @method('delete')
                                    <button class="btn-sm btn-danger" type="submit">Delete</button>

                                    {{-- @endcan --}}
                            </form>
                            </td>
                            {{-- @endif  --}}
                        </tr>
                        @empty
                        <td class="text-center" colspan="10">No Data Available</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{$blogs->links()}}
            </div>
            <!-- /.card -->
        </div>
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