@extends('backend.master')
@section('product_active')
active
@endsection
@section('product_add-active')
active
@endsection
@section('product_dropdown_active')
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
                    <h1 class="m-0">Add Product</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-12">
                <form enctype="multipart/form-data" action="{{route('products.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="catagory_id">Product name</label>
                        <input value="{{old('product_name')}}" name="product_name" type="text"
                            placeholder="Product Name" autocomplete="none" class="form-control @error('product_name') is-invalid                                
                            @enderror">
                        @error('product_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="catagory_id">Catagory</label>
                        <select title="Select Catagory" class="form-control  @error('catagory_name') is-invalid                                
                        @enderror" name="catagory_name" id="catagory_id">
                            <option value>Select One</option>
                            @foreach ($catagories as $catagory)
                            <option value="{{$catagory->id}}">{{$catagory->catagory_name}}</option>
                            @endforeach
                        </select>
                        @error('catagory_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="catagory_id">Sub Catagory</label>
                        <select title="Select Catagory" class="form-control  @error('subcatagory_name') is-invalid                            
                        @enderror" name="subcatagory_name" id="subcatagory_id" disabled>

                        </select>
                        @error('subcatagory_name')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-8 mt-4 pt-4">
                                <label for="thumbnail_img">Thumbnail Image</label>
                                <input class="form-control @error('thumbnail_img') is-invalid @enderror" type="file"
                                    name="thumbnail_img"
                                    onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">

                                @error('thumbnail_img')
                                <div class="alert alert-danger">
                                    {{$message}}
                                </div>
                                @else
                                <span class="text-danger">Only png formate will allow</span>
                                @enderror
                            </div>


                            <div class="col-4 pl-4">
                                <div>
                                    <label for="image_id">*Thumbnail Preview</label>
                                </div>
                                &nbsp;<img id="image_id" width="150" height="150" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product_img">Product Images</label>
                        <input type="file" name="product_img[]" id="product_img" multiple
                            class="form-control @error('product_img.*') is-invalid @enderror">

                        @error('product_img>8')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @else
                        <span class="text-danger">Only png,jpg,jpeg formate will allow</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_summary">Summary</label>
                        <textarea class="form-control @error('product_summary') is-invalid @enderror"
                            name="product_summary" id="product_summary"></textarea>
                        @error('product_summary')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="product_description">Description</label>
                        <textarea class="form-control @error('product_description') is-invalid @enderror"
                            name="product_description" id="product_description"></textarea>
                        @error('product_description')
                        <div class="alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>




                    <div class="form-group ">
                        <div id="dynamic-field-1" class="form-group dynamic-field mt-4">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <label for="color_id" class="font-weight-bold">Color</label>
                                    <select class="form-control " name="color_id[]" id="color_id">
                                        {{-- <option value>Select One</option> --}}
                                        @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->color_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <label for="size_id" class="font-weight-bold">Size</label>
                                    <select class="form-control " name="size_id[]" id="size_id">
                                        {{-- <option value>Select One</option> --}}
                                        @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">{{ $size->size_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-2 col-4">
                                    <label for="quantity" class="font-weight-bold">Quantity</label>
                                    <input type="number" id="quantity"
                                        class="form-control @error('quantity.*') is-invalid  @enderror"
                                        name="quantity[]">
                                    @error('quantity.*')
                                    <span style="color: red">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-2 col-4">
                                    <label for="regular_price" class="font-weight-bold ">Regular Price</label>
                                    <input type="number" id="regular_price"
                                        class="form-control   @error('regular_price.*') is-invalid  @enderror"
                                        name="regular_price[]">
                                    @error('regular_price.*')
                                    <span style="color: red">*{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-2 col-4">
                                    <label for="selling_price" class="font-weight-bold">Discount(%)</label>
                                    <input type="number" id="selling_price" class="form-control  @error('selling_price.*') is-invalid  @enderror" name="selling_price[]">
                                    @error('selling_price.*')
                                    <span style="color: red">*{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="clearfix">
                            <button type="button" id="remove-button" title="Remove Last added field"
                                style="color:red;background:none;border:1px"
                                class="btn-sm btn-secondary ml-2 float-right ml-1" disabled="disabled"><i
                                    class="fa fa-minus fa-fw"></i> Remove</button>
                            <button title="Add new field" type="button" id="add-button"
                                style="background-color: #6c757d;color:white;border:none;"
                                class="btn-sm float-right  shadow-sm"><i class="fa fa-plus fa-fw"></i>
                                Add</button>
                        </div>
                    </div>



                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection



@section('script_js')
<script>
    $('#catagory_id').change(function() {
            $catagory_id = $(this).val();
            // alert($catagory_id);
            if ($catagory_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('admin/products/get-sub-cat/') }}/" + $catagory_id,
                    //  url: "{{ url('get/size/price') }}/" + color_id + '/' + product_id,

                    success: function(res) {
                        if (res) {
                            $('#subcatagory_id').removeAttr('disabled');
                            $("#subcatagory_id").empty();
                            $("#subcatagory_id").append('<option value=>Select One</option>');
                            $.each(res, function(key, value) {
                                $("#subcatagory_id").append('<option value="' + value.id + '" >' +
                                    value.subcatagory_name + '</option>');
                            });

                        } else {
                            $("#subcatagory_id").empty();
                        }
                    }
                });
            } 
            else {
                 $("#subcatagory_id").empty();
                        }
        });

    //     $("#addRow").click(function () {
    //     var html = '';
    //     html += '<div id="inputFormRow">';
    //     html += '<div class="input-group mb-3">';
    //     html += '<input type="text" name="flavour_name[]" class="form-control m-input " placeholder="Enter Flavour Name" autocomplete="off">';
    //     html += '<div class="input-group-append">';
    //     html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
    //     html += '</div>';
    //     html += '</div>';

    //     $('#newRow').append(html);
    // });

  



// dynamic add remove function
        $(document).ready(function() {
            var buttonAdd = $("#add-button");
            var buttonRemove = $("#remove-button");
            var className = ".dynamic-field";
            var count = 0;
            var field = "";
            var maxFields = 15;

            function totalFields() {
                return $(className).length;
            }

            function addNewField() {
                count = totalFields() + 1;
                field = $("#dynamic-field-1").clone();
                field.attr("id", "dynamic-field-" + count);
                field.children("label").text("Field " + count);
                field.find("input").val("");
                $(className + ":last").after($(field));
            }

            function removeLastField() {
                if (totalFields() > 1) {
                    $(className + ":last").remove();
                }
            }

            function enableButtonRemove() {
                if (totalFields() === 2) {
                    buttonRemove.removeAttr("disabled");
                    buttonRemove.addClass("shadow-sm");
                }
            }

            function disableButtonRemove() {
                if (totalFields() === 1) {
                    buttonRemove.attr("disabled", "disabled");
                    buttonRemove.removeClass("shadow-sm");
                }
            }

            function disableButtonAdd() {
                if (totalFields() === maxFields) {
                    buttonAdd.attr("disabled", "disabled");
                    buttonAdd.removeClass("shadow-sm");
                }
            }

            function enableButtonAdd() {
                if (totalFields() === (maxFields - 1)) {
                    buttonAdd.removeAttr("disabled");
                    buttonAdd.addClass("shadow-sm");
                }
            }

            buttonAdd.click(function() {
                addNewField();
                enableButtonRemove();
                disableButtonAdd();
            });

            buttonRemove.click(function() {
                removeLastField();
                disableButtonRemove();
                enableButtonAdd();
            });
        });


        ClassicEditor
            .create( document.querySelector( '#product_description' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );


</script>

@endsection