@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Roles</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="font-weight-bold text-primary">Users Table</h6> -->
                <span style="float: right;"><a href="{{ route('admin.add.roles') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add Roles</span>
                    </button></span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Permission</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($roles as $key => $value)
                            <tr>
                                <td>{{ $value->name }}</td>
                                

                                <td>
                                    @foreach($value->permissions as $val)
                                    <span class="badge bg-danger">{{ $val->name }}</span>
                                    @endforeach
                                </td>
                                

                                <td><a class="" href="{{ route('admin.edit.roles.permission',$value->id) }}"><i class="fas fa-edit"></i></a> / 
                                    
                                    <a class="" href="{{ route('admin.delete.roles.permission',$value->id) }}"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
