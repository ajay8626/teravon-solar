@extends('layouts.app')

@section('content')
    <div class="container-fluid">
       <!-- DataTales Example -->
        <h1 class="h3 mb-2 text-gray-800">{{ __('General Check Points List') }}</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="{{ route('admin.general-check-points.add') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add General Check Points</span>
                    </button>
                </a>
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-primary alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ $message }}
                </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Check Points Question</th>
                                <th>Frequency</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                             @foreach($general_check_points as $checkPointsVal)
                            <tr>
                                <td>{{ isset($categories[$checkPointsVal->category_id])?$categories[$checkPointsVal->category_id]:"" }}</td>
                                <td>{{ isset($subCategories[$checkPointsVal->sub_category_id])?$subCategories[$checkPointsVal->sub_category_id]:"" }}</td>
                                <td>{{ isset($checkPointsVal->check_points_question)?$checkPointsVal->check_points_question:"" }}</td>
                                <td>{{ isset($frequency[$checkPointsVal->frequency])?$frequency[$checkPointsVal->frequency]:"" }}</td>
                                <td>
                                    <a class="" href="{{ route('admin.general-check-points.edit',$checkPointsVal->id) }}"><i class="fas fa-edit"></i></a> / 
                                    
                                    <a class="" href="{{ route('admin.general-check-points.delete',$checkPointsVal->id) }}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

