@extends('layouts.app')

@section('content')
<div class="">
    <!-- Responsive Table -->
    <div class="container">
        <div class="row">
            
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Project') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        <a href="{{ route('admin.projects.index') }}">
                            <button class="btn btn-warning btn-icon btn-icon-standalone btn-icon-standalone-right">
                                <i class="fas fa-arrow-left"></i>
                                <span>Back</span>
                            </button>
                        </a>
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-primary alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    {{ $message }}
                                </div>
                            @endif
                            
                            <form method="POST" id="productForm" action="{{ route('admin.projects.store') }}">
                            @csrf
                                <div col-md-12>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Name of Client</label>
                                                <input type="text" name="name_of_client" class="form-control" placeholder="{{ __('Name of Client') }}" value="{{ isset($project) ? $project->project_name : ''  }}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea id="address" name="address" placeholder="Address" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Capacity (AC)</label>
                                            <input type="text" name="capacity_ac" class="form-control" placeholder="{{ __('Capacity (AC)') }}" value="{{ isset($project) ? $project->capacity_ac : ''  }}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Capacity (DC)</label>
                                            <input type="text" name="capacity_dc" class="form-control" placeholder="{{ __('Capacity (DC)') }}" value="{{ isset($project) ? $project->capacity_dc : ''  }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Project Commissioned on</label>
                                            <input type="date" name="project_commissioned_on" class="form-control" placeholder="{{ __('Project Commissioned on') }}" value="{{ isset($project) ? $project->project_commissioned_on : ''  }}" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>No. of Panels</label>
                                                <input type="number" name="no_of_panels" class="form-control" placeholder="{{ __('No. of Panels') }}" value="{{ isset($project) ? $project->no_of_panels : ''  }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Watt-Peak (wp):</label>
                                                <input type="number" name="watt_peak" class="form-control" placeholder="{{ __('Watt-Peak (wp)') }}" value="{{ isset($project) ? $project->watt_peak : ''  }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h4>Maintenance</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Category:</label>
                                                <select type="text" name="category" id="categoryName" class="form-control">
                                                    <option value="">--Select Category--</option>
                                                    @foreach($categories as $key => $category)
                                                        <option value="{{ $key }}">{{ $category }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Sub Category</label>
                                                <select type="text" name="subcategory" id="subCategory" class="form-control">
                                                    <option value="">--Select Sub Category--</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <h4>Select Users</h4>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                            <label>Project Head:</label>
                                                <select type="text" name="project_head" class="form-control">
                                                    <option value="">--Project Head--</option>
                                                    @foreach($users as $key => $user)
                                                        <option value="{{ $key }}">{{ $user }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <vbnhdiv class="col-sm-6">
                                            <div class="form-group">
                                                <label>Maintenance Engg</label>
                                                <select type="text" name="maintenance_engg" class="form-control">
                                                    <option value="">--Maintenance Engg--</option>
                                                    @foreach($users as $key => $user)
                                                        <option value="{{ $key }}">{{ $user }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <!-- <h4>Solar Panel Cleaning</h4>
                                    <div class="row">
                                        
                                    </div> -->
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(document).ready(function () {
    $('#categoryName').change(function (e) {
        var cat_id = e.target.value;
        $.ajax({
           type:"POST",
           url:"{{ route('admin.general-check-points.getSubCategoryAjax') }}",
           data: {
               cat_id: cat_id,
               _token: $('meta[name="csrf-token"]').attr('content'),
            },
           
            success:function (data) {
                $('#subCategory').empty();
                $.each(data.subcategories,function(index,subcategory){
                    $('#subCategory').append('<option value="'+index+'">'+subcategory+'</option>');
                })
            }
       })
    });
});
</script>
@endsection

