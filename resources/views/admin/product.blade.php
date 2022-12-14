@extends('layouts.admin')

@section('title', 'Product')

@section('header')

@endsection

@section('content')

<!-- Adding Product modal -->

<div class=" col-sm-12 text-right">
    <a href="{{url('/product/addProduct')}}" id="createBtn" class="btn btn-primary btn-lg m-4 has-ripple">
        <i class="fas fa-plus"></i>
        Create Product
    </a>

    <!--Excel Modal-->
    <div class="modal fade" id="importModal" data-backdrop="static" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times" style="font-size: 20px;"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{url('/product/importProduct')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="col-sm-12 text-left">
                                <div class="form-group">
                                    <label style="font-weight: bold; font-size: large;">Import Product details using excel</label>
                                </div>
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                    <label class="p-3" style="font-weight: bold;">Select Excel File <span style="color: red;">&#42</span></label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="excel" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <a href="{{url('storage/ExcelFiles/Product/ProductExcelFormat.xlsx')}}" id="download" download class="btn btn-success"><i class="fas fa-cloud-download-alt"></i>or Download format
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{url('/product/importProductMacro')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="col-sm-12 text-left">
                                <div class="form-group">
                                    <label style="font-weight: bold; font-size: large;">Import Product Macros using excel</label>
                                </div>
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                    <label class="p-3" style="font-weight: bold;">Select Excel File <span style="color: red;">&#42</span></label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="excel" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <a href="{{url('storage/ExcelFiles/Product/ProductMacroExcelFormat.xlsx')}}" id="download" download class="btn btn-success"><i class="fas fa-cloud-download-alt"></i>or Download format
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{url('/product/importProductRecipe')}}" method="post" enctype="multipart/form-data">
                        <div class="row">
                            @csrf
                            <div class="col-sm-12 text-left">
                                <div class="form-group">
                                    <label style="font-weight: bold; font-size: large;">Import Product Recipes using excel</label>
                                </div>
                            </div>
                            <div class="col-sm-3 text-left">
                                <div class="form-group">
                                    <label class="p-3" style="font-weight: bold;">Select Excel File <span style="color: red;">&#42</span></label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="excel" required>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <a href="{{url('storage/ExcelFiles/Product/ProductRecipeExcelFormat.xlsx')}}" id="download" download class="btn btn-success"><i class="fas fa-cloud-download-alt"></i>or Download format
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<div class="col-sm-12">
    <div class="alert alert-{{ $msg }} alert-dismissible fade show" role="alert">
        {{ Session::get('alert-' . $msg) }}.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@endforeach
<div class="row">
    @if(Session::has('counter'))
    <div class="col-sm-6">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('counter') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if(Session::has('success'))
    <div class="col-sm-6">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <!-- @if(Session::has('repeated'))
    <div class="col-sm-3">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('repeated') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    @if(Session::has('failed'))
    <div class="col-sm-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('failed') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif -->
    @if ($errors->any())
    <div class="col-sm-12">
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endforeach
    </div>
    @endif
</div>

@if(Session::has('failedIds'))
<!-- count number of failedids -->
@php
$failedIds = Session::get('failedIds');
$failedIdsCount = count($failedIds);
@endphp
@if($failedIdsCount > 0)
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Failed to import {{ $failedIdsCount }} Records.</strong> <br>
            Row :
            @foreach(Session::get('failedIds') as $failedId)
            <!-- Add and if last entry or a comma  -->
            {{ $failedId }}@if(!$loop->last),@endif
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@endif

@if(Session::has('repeatedIds'))
<!-- count number of repeatedIds -->
@php
$repeatedIds = Session::get('repeatedIds');
$repeatedIdsCount = count($repeatedIds);
@endphp
@if($repeatedIdsCount > 0)
<div class="row">
    <div class="col-sm-12">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ $repeatedIdsCount }} Repeated Records Found.</strong> <br>
            Row :
            @foreach(Session::get('repeatedIds') as $repeatedId)
            <!-- Add and if last entry or a comma  -->
            {{ $repeatedId }}@if(!$loop->last),@endif
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@endif

<?php
isset($_GET['category']) ? $categoryFilter = $_GET['category'] : $categoryFilter = '';
isset($_GET['subCategory']) ? $subCategoryFilter = $_GET['subCategory'] : $subCategoryFilter = '';
isset($_GET['mealType']) ? $mealTypeFilter = $_GET['mealType'] : $mealTypeFilter = '';
isset($_GET['alaCart']) ? $alaCart = $_GET['alaCart'] : $alaCart = '';
?>

<!-- filter -->
<div class="col-sm-12 mt-3">
    <form action="{{url('/product')}}" method="get">
        <div class="card card-custom">
            <div class="card-header flex-wrap">
                <div class="card-title">
                    <h4>Product Filter</h4>
                </div>
            </div>
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Category</label>
                            <select class="form-control" name="category" id="categoryList">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)

                                <option value="{{$category->id}}" {{$category->id == $categoryFilter ? 'selected' : ''}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select class="form-control" name="subCategory" id="subCategoryList">
                                <option value="">Select Sub Category</option>
                                @foreach($subcategories as $subCategory)
                                <option value="{{$subCategory->id}}" class="parent-{{$subCategory->categoryId}} subcategory" {{$subCategory->id == $subCategoryFilter ? 'selected' : ''}}>{{$subCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Meal Type</label>
                            <select class="form-control" name="mealType" id="mealTypeList">
                                <option value="">Select Meal Type</option>
                                @foreach($mealTypes as $mealType)
                                <option value="{{$mealType->id}}" {{$mealType->id == $mealTypeFilter ? 'selected' : ''}}>{{$mealType->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label>Ala Cart</label>
                            <select class="form-control" name="alaCart" id="alaCartList">
                                <option value="">Select Ala Cart Status</option>
                                <option value="1" {{ $alaCart == 1 ? 'selected' : ''}}>Yes</option>
                                <option value="0" {{ $alaCart == 0 ? 'selected' : ''}}>No</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>
<!-- table section -->

<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h4>Product List</h4>
            </div>
            <div class="card-toolbar">
                <div class="dropdown dropdown-inline mr-2">
                    <button type="button" id="export" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="far fa-file-excel"></i>Export</button>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                        <ul class="navi flex-column navi-hover py-2">
                            <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                            <!-- <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-print"></i>
                                    </span>
                                    <span class="navi-text">Print</span>
                                </a>
                            </li>
                            <li class="navi-item">
                                <a href="#" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-copy"></i>
                                    </span>
                                    <span class="navi-text">Copy</span>
                                </a>
                            </li> -->
                            <li class="navi-item">
                                <a href="{{url('/product/exportProductExcel')}}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-excel-o"></i>
                                    </span>
                                    <span class="navi-text">Excel</span>
                                </a>
                            </li>
                            <!-- <li class="navi-item">
                                <a href="{{url('/user/exportToCSV')}}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-text-o"></i>
                                    </span>
                                    <span class="navi-text">CSV</span>
                                </a>
                            </li> -->
                            <!-- <li class="navi-item">
                                <a href="{{url('/user/exportToPDF')}}" class="navi-link">
                                    <span class="navi-icon">
                                        <i class="la la-file-pdf-o"></i>
                                    </span>
                                    <span class="navi-text">PDF</span>
                                </a>
                            </li> -->
                        </ul>
                    </div>
                </div>

                <button type="button" id="addExcel" class="btn btn-primary has-ripple" data-toggle="modal" data-target="#importModal"><i class="fas fa-file-import"></i>Import Excel</button>
            </div>
        </div>
        <div class="card-body">
            <div class="dt-responsive table-responsive">
                <table id="tabdata" class="table table-striped table-bordered nowrap">
                    <thead>
                        @php($i = 1)
                        <tr class="text-center">
                            <th>Sr.no</th>
                            <th>UID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discounted Price</th>
                            <th>Meal Time</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Meal Type</th>
                            <th>Ala Cart</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $data )
                        <tr>
                            <td class="align-middle text-center">{{$i++}}</td>
                            <td class="align-middle text-center">{{$data->UID}}</td>
                            <td class="align-middle text-center">
                                <a data-toggle="modal" data-target="#displayMedia{{$data->id}}">
                                    <img src="{{$data->image != null ? $data->image : '\media\imageNotAdded.jpg'}}" onerror="this.src='media/imageNotAdded.jpg'" alt="Tesimonial Image" style="height: 50px; width: 50px;">
                                </a>
                            </td>
                            <td class="align-middle text-center">{{$data->name}}</td>
                            <td class="align-middle text-center">{{$data->price}}</td>
                            <td class="align-middle text-center">{{$data->discountedPrice}}</td>
                            <td class="align-middle text-center" style="white-space: initial; width: 70px;">
                                <?php
                                $mealTime = $data->mealTime;
                                $mealTime = explode(',', $mealTime);
                                ?>
                                @foreach($mealTime as $time)
                                @if($time == 'b')
                                <span class="badge badge-primary" style="margin-top: 5px;">Break Fast</span>
                                @endif
                                @if($time == 'l')
                                <span class="badge badge-primary" style="margin-top: 5px;">Lunch</span>
                                @endif
                                @if($time == 's')
                                <span class="badge badge-primary" style="margin-top: 5px;">Snack</span>
                                @endif
                                @if($time == 'd')
                                <span class="badge badge-primary" style="margin-top: 5px;">Dinner</span>
                                @endif

                                @endforeach
                            </td>
                            <td class="align-middle text-center">
                                @if(isset($data->category))
                                {{$data->category->name}}
                                @else
                                <span class="text-danger">Category Not Found</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                @if(isset($data->subcategory))
                                {{$data->subcategory->name}}
                                @else
                                <span class="text-danger">Sub Category Not Found</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                @if(isset($data->mealtype))
                                {{$data->mealtype->name}}
                                @else
                                <span class="text-danger">Meal Type Not Found</span>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                @if($data->alaCartFlag == 1)
                                <i class="fas fa-check-circle text-success"></i>
                                @else
                                <i class="fas fa-times-circle text-danger"></i>
                                @endif
                            </td>
                            <td class="align-middle text-center">
                                <input type="checkbox" data-id="{{$data->id}}" class="toggle-class" data-style="slow" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Active" data-off="Deactive" {{ $data->status == '1' ? 'checked' : ''}}>
                            </td>
                            <td class="table-action text-center">
                                <div>
                                    <!-- <a href="{{url('/product/productRecipe')}}/{{$data->UID}}" class="btn btn-icon btn-outline-primary has-ripple" ><i class="fas fa-utensils"></i></a> -->
                                    <a href="{{url('/product/updateProduct')}}/{{$data->slug}}" class="btn btn-icon btn-outline-warning has-ripple"><i class="fas fa-pen"></i></a>
                                    <a href="#" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a>

                                </div>
                            </td>

                            <!--Image Modal -->
                            <div class="modal fade" id="displayMedia{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Media</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times" style="font-size: 25px; "></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <img src="{{$data->image != null ? $data->image : '\media\imageNotAdded.jpg'}}" onerror="this.src='media/imageNotAdded.jpg'" alt="Tesimonial Image" style="height: 400px; width: 600px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Delete Modal -->
                            <div class="modal fade" id="deleteModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times" style="font-size: 25px; "></i>
                                            </button>
                                        </div>

                                        <form action="{{url('/product/deleteProduct')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                            <div class="modal-body">
                                                <p style="color: black;"> Are you sure you want to delete this Product? <br> ACTION CAN NOT BE REVERTED </p>
                                                <div class="modal-footer">
                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-trash-alt" style="font-size: 20px;"></i>Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $('.toggle-class').on('change', function() {
        var status = $(this).prop('checked') == true ? '1' : '0';
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            url: "/product/status",
            data: {
                'status': status,
                'user_id': user_id,
            },
            dataType: "json",
            success: function(data) {

            }
        });
    });
</script>

<script>
    $('#categoryList').on('change', function() {
        $("#subCategoryList").attr('disabled', false); //enable subcategory select
        $("#subCategoryList").val("");
        $(".subcategory").attr('disabled', true); //disable all category option
        $(".subcategory").hide(); //hide all subcategory option
        $(".parent-" + $(this).val()).attr('disabled', false); //enable subcategory of selected category/parent
        $(".parent-" + $(this).val()).show();
    });
</script>

@endsection