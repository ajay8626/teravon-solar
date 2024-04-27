@extends('layouts.app')

@section('content')
    <div class="container-fluid">
       <!-- DataTales Example -->
        <h1 class="h3 mb-2 text-gray-800">{{ __('Category List') }}</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="{{ route('admin.categories.add') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add New Category</span>
                    </button>
                </a>
                <a href="{{ route('admin.sub-categories.add') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add New Sub Category</span>
                    </button>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                             @foreach($categories as $catVal)
                            <tr>
                                <td>{{ $catVal->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.categories.edit',$catVal->id) }}"><i class="fas fa-edit"></i></a>
                                    
                                    <a class="btn btn-danger" href="{{ route('admin.categories.delete',$catVal->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

