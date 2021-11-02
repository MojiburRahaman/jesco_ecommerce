@extends('backend.master')

@section('role_dropdown_active')
menu-open
@endsection
@section('role_active')
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
                    <h1 class="m-0">Add Role</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form action="{{route('roles.update',$role->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="color_name">Role Name</label>
                        <input id="role_name" name="role_name" type="text" placeholder="Role Name" autocomplete="none" value="{{$role->name}}"
                            class="form-control @error('role_name') is-invalid                                
                            @enderror">
                        @error('role_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Choose Permissions:</label>
                        @foreach ($permissions as $permission)
                        <div>
                            <input 
                            {{($role->hasPermissionTo($permission->id))? 'checked': ''}}
                            id="permission_name{{$permission->id}}" name="permission[]" type="checkbox"
                                value="{{$permission->id}}">
                            &nbsp; <label for="permission_name{{$permission->id}}">{{$permission->name}}</label>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection