@extends('layouts.admin')

@section('title', 'Addon')

@section('header')

@endsection

@section('content')


<!-- Adding Addon modal -->

<div class=" col-sm-12 text-right">
    <button type="button" id="createBtn" class="btn btn-primary btn-lg m-4 has-ripple" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus"></i> Add Addon
    </button>
</div>

<div class="modal fade" id="addModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Create Addon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times" style="font-size: 25px;"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/addon/addAddon')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="form-group">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url(assets/media/users/blank.png)">
                                    <div class="image-input-wrapper"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                        <input type="file" name="image" required accept=".png, .jpg, .jpeg" style="height: 1px!important; width: 1px!important" />
                                        <input type="hidden" name="profile_avatar_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="Name"> Name <span style="color: red;">&#42</span></label>
                                <input type="text" class="form-control" id="Name" name="name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="Number">Price <span style="color: red;">&#42</span></label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="Number">Quantity <span style="color: red;">&#42</span></label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="Name">Unit <span style="color: red;">&#42</span></label>
                                <select class="form-control selectpicker" id="Unit" name="unit" required>
                                    <option value="Gram">Grams</option>
                                    <option value="ml">Milliliter</option>
                                    <option value="Pcs">pieces</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="role">Ala cart <span style="color: red;">&#42</span></label>
                                <select class="form-control selectpicker" name="alaCart" id="alaCart">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="role">Meal Type <span style="color: red;">&#42</span></label>
                                <select class="form-control selectpicker" name="mealType" id="mealType">
                                    <optgroup label="Meal types">
                                        @foreach($mealTypes as $mealType)
                                        <option value="{{$mealType->id}}">{{$mealType->name}}</option>
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="role">Addon Status <span style="color: red;">&#42</span></label>
                                <select class="form-control selectpicker" name="status" id="status">
                                    <optgroup label="Status">
                                        <option value="1">Active</option>
                                        <option value="0">InActive</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label style="font-weight: bold;" for="description">Description <span style="color: red;">&#42</span></label> <br>
                                <textarea class="form-control" name="description" id="Description" required></textarea>
                            </div>
                        </div>
                        <div class="col-sm-12 modal-footer">
                            <button type="submit" id="addBtn" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Add Addon
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Excel Modal-->
<div class="modal fade" id="importModal" data-backdrop="static" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times" style="font-size: 20px;"></i></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/addon/importAddon')}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-sm-12 text-left">
                            <div class="form-group">
                                <label style="font-weight: bold; font-size: large;">Import Addons using excel</label>
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
                                <a href="{{url('storage/ExcelFiles/Product/AddonFormat.xlsx')}}" id="download" download class="btn btn-success"><i class="fas fa-cloud-download-alt"></i>or Download format
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
@if(Session::has('alert-' . $msg))
<div class="col-sm-12">
    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
</div>
@endif
@endforeach


<!-- table section -->

<div class="col-sm-12 mt-3">
    <div class="card card-custom">
        <div class="card-header flex-wrap">
            <div class="card-title">
                <h5>Addons</h5>
            </div>
            <div class="card-toolbar">
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>MealType</th>
                            <th>AlaCart</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($addons as $data )
                        <tr>
                            <td class="align-middle text-center">{{$i++}}</td>
                            <td class="align-middle text-center">
                                <!-- image -->
                                <a data-toggle="modal" data-target="#displayMedia{{$data->id}}">
                                    <img src="{{$data->image != null ? $data->image : '\media\imageNotAdded.jpg'}}" onerror="this.src='media/imageNotAdded.jpg'" alt="Tesimonial Image" style="height: 50px; width: 50px;">
                                </a>
                            </td>
                            <td class="align-middle text-center">{{$data->name}}</td>
                            <td class="align-middle text-center">{{$data->price}}</td>
                            <td class="align-middle text-center">{{$data->quantity}}</td>
                            <td class="align-middle text-center">{{$data->unit}}</td>
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
                                <!-- <input type="checkbox" data-id="{{$data->id}}" class="toggle-class" data-style="slow" data-toggle="toggle" data-onstyle="success" data-offstyle="danger" data-on="Active" data-off="InActive" {{ $data->status == '1' ? 'checked' : ''}}> -->
                            
                                @if($data->status == 1)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">InActive</span>
                                @endif
                            </td>
                            <td class="table-action text-center">
                                <div>
                                    <!-- <a href="" class="btn btn-icon btn-outline-primary has-ripple" data-toggle="modal" data-target="#showModal{{$data->id}}"><i class="far fa-eye"></i><span class="ripple ripple-animate" style="height: 45px; width: 45px; animation-duration: 0.7s; animation-timing-function: linear; background: rgb(255, 255, 255); opacity: 0.4; top: 7.39999px; left: -12.6px;"></span></a> -->
                                    <a href="" class="btn btn-icon btn-outline-warning has-ripple" data-toggle="modal" data-target="#updateModal{{$data->id}}"><i class="fas fa-pen"></i></a>
                                    <a href="" class="btn btn-icon btn-outline-danger has-ripple" data-toggle="modal" data-target="#deleteModal{{$data->id}}"><i class="far fa-trash-alt"></i></a>

                                </div>
                            </td>

                            <!--Image Modal -->
                            <div class="modal fade" id="displayMedia{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Media</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times" style="font-size: 25px; "></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12 text-center">
                                                    <img src="{{$data->image != null ? $data->image : '\media\imageNotAdded.jpg'}}" onerror="this.src='media/imageNotAdded.jpg'" alt="Tesimonial Image" style="height: 250px; width: 250px;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Update Modal -->
                            <div class="modal fade" id="updateModal{{$data->id}}" data-backdrop="static" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-weight: 600; color: black; font-size: large;">Update Addon</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times" style="font-size: 25px; "></i>
                                            </button>
                                        </div>
                                        <div class="modal-body" style="color: black;">
                                            <form action="{{url('/addon/updateAddon')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                                <div class="row">
                                                    <div class="col-sm-12 text-center">
                                                        <div class="form-group">
                                                            <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url(assets/media/users/blank.png)">
                                                                <div class="image-input-wrapper" style="background-image: url({{$data->image}})"></div>
                                                                <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                                    <i class="fa fa-pen icon-sm text-muted"></i>
                                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                                    <input type="hidden" name="profile_avatar_remove" />
                                                                </label>
                                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>
                                                                <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove avatar">
                                                                    <i class="ki ki-bold-close icon-xs text-muted"></i>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="Name"> Name <span style="color: red;">&#42</span></label>
                                                            <input type="text" class="form-control" id="Name" name="name" value="{{$data->name}}" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="role">Addon Status <span style="color: red;">&#42</span></label>
                                                            <select class="form-control selectpicker" name="status" id="status">
                                                                <optgroup label="Status">
                                                                    <option value="1" {{$data->status == 1 ? 'selected' : ''}}>Active</option>
                                                                    <option value="0" {{$data->status == 0 ? 'selected' : ''}}>InActive</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="Number">Price <span style="color: red;">&#42</span></label>
                                                            <input type="number" class="form-control" id="price" name="price" value="{{$data->price}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="Number">Quantity <span style="color: red;">&#42</span></label>
                                                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{$data->quantity}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="Name">Unit <span style="color: red;">&#42</span></label>
                                                            <select class="form-control selectpicker" id="Unit" name="unit" required>
                                                                <option value="Gram" {{$data->unit == 'Gram' ? 'selected' : ''}}>Grams</option>
                                                                <option value="ml" {{$data->unit == 'ml' ? 'selected' : ''}}>Milliliter</option>
                                                                <option value="Pcs" {{$data->unit == 'Pcs' ? 'selected' : ''}}>pieces</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="role">Ala cart <span style="color: red;">&#42</span></label>
                                                            <select class="form-control selectpicker" name="alaCart" id="alaCart">
                                                                <option value="1" {{$data->alaCart == 1 ? 'selected' : ''}}>Yes</option>
                                                                <option value="0" {{$data->alaCart == 0 ? 'selected' : ''}}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="role">Meal Type <span style="color: red;">&#42</span></label>
                                                            <select class="form-control selectpicker" name="mealType" id="mealType">
                                                                <optgroup label="Meal types">
                                                                    @foreach($mealTypes as $mealType)
                                                                    <option value="{{$mealType->id}}" {{$data->mealTypeId == $mealType->id ? 'selected' : ''}}>{{$mealType->name}}</option>
                                                                    @endforeach
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label style="font-weight: bold;" for="description">Description <span style="color: red;">&#42</span></label> <br>
                                                            <textarea class="form-control" name="description" id="Description" required>{{$data->description}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 modal-footer">
                                                        <button type="submit" id="updateBtn{{$data->id}}" class="btn btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                            Update Addon
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
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

                                        <form action="{{url('/addon/deleteAddon')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="hiddenId" value="{{$data->id}}">
                                            <div class="modal-body">
                                                <p style="color: black;"> Are you sure you want to delete this Addon? <br> ACTION CAN NOT BE REVERTED </p>
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
            url: "{{url('/addon/status')}}",
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
    function checkUID() {
        var uid = document.getElementById('UID').value;
        var uidField = document.getElementById('UID');
        var errorTitle = document.getElementById('uidTitle');

        if (uid == '') {
            errorTitle.innerHTML = "UID is required";
            errorTitle.style.color = "red";
            uidField.style.borderColor = "red";
            document.getElementById('addBtn').disabled = true;
        } else {
            $.ajax({
                type: "get",
                url: "{{url('/addon/checkUID')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'uid': uid,
                },
                dataType: "json",
                success: function(response) {
                    errorTitle.innerHTML = "UID already exists";
                    errorTitle.style.color = "red";
                    uidField.style.borderColor = "red";
                    document.getElementById('addBtn').disabled = true;
                },
                error: function(response) {
                    errorTitle.innerHTML = 'UID is valid';
                    errorTitle.style.color = "green";
                    uidField.style.borderColor = "green";
                    document.getElementById('addBtn').disabled = false;
                }
            });
        }
    }

    function checkUUID(id) {
        console.log(id);
        var uid = document.getElementById('UID' + id).value;
        var uidField = document.getElementById('UID' + id);
        var errorTitle = document.getElementById('uidTitle' + id);

        if (uid == '') {
            errorTitle.innerHTML = "UID is required";
            errorTitle.style.color = "red";
            uidField.style.borderColor = "red";
            document.getElementById('updateBtn' + id).disabled = true;
        } else {
            $.ajax({
                type: "get",
                url: "{{url('/addon/checkUID')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'uid': uid,
                },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    if (response.status == 200) {
                        errorTitle.innerHTML = "UID already exists";
                        errorTitle.style.color = "red";
                        uidField.style.borderColor = "red";
                        document.getElementById('updateBtn' + id).disabled = true;
                    } else if (response.status == 201) {
                        errorTitle.innerHTML = 'This is your current UID';
                        errorTitle.style.color = "green";
                        uidField.style.borderColor = "green";
                        document.getElementById('updateBtn' + id).disabled = false;
                    }

                },
                error: function(response) {
                    console.log(response);
                    errorTitle.innerHTML = 'UID is valid';
                    errorTitle.style.color = "green";
                    uidField.style.borderColor = "green";
                    document.getElementById('updateBtn' + id).disabled = false;
                }
            });
        }
    }
</script>



<script>
    var namee = document.getElementById("Name");
    var description = document.getElementById("Description");

    namee.addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Addon Name is required');
        } else if (event.target.validity.tooShort) {
            event.target.setCustomValidity('Addon Name Too short');
        } else if (event.target.validity.patternMismatch) {
            event.target.setCustomValidity('Only Alphabets are allowed');
        }
    })
    namee.addEventListener('change', function(event) {
        event.target.setCustomValidity('');
    })
    description.addEventListener('invalid', function(event) {
        if (event.target.validity.valueMissing) {
            event.target.setCustomValidity('Addon is required');
        } else if (event.target.validity.tooShort) {
            event.target.setCustomValidity('Addon Too short');
        }
    })
    description.addEventListener('change', function(event) {
        event.target.setCustomValidity('');
    })
</script>

<script>
    function getId(id) {
        var enamee = document.getElementById("EName" + id);
        var edescription = document.getElementById("EDescription" + id);

        enamee.addEventListener('invalid', function(event) {
            if (event.target.validity.valueMissing) {
                event.target.setCustomValidity('Addon Name is required');
            } else if (event.target.validity.tooShort) {
                event.target.setCustomValidity('Addon Name Too short');
            } else if (event.target.validity.patternMismatch) {
                event.target.setCustomValidity('Only Alphabets are allowed');
            }
        })
        enamee.addEventListener('change', function(event) {
            event.target.setCustomValidity('');
        })
        edescription.addEventListener('invalid', function(event) {
            if (event.target.validity.valueMissing) {
                event.target.setCustomValidity('Addon is required');
            } else if (event.target.validity.tooShort) {
                event.target.setCustomValidity('Addon Too short');
            }
        })
        edescription.addEventListener('change', function(event) {
            event.target.setCustomValidity('');
        })
    }
</script>
@endsection