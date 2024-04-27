@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">All Permission</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="font-weight-bold text-primary">Users Table</h6> -->
                <span style="float: right;"><a href="{{ route('admin.add.permission') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add Permission</span>
                    </button></span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Permission Name</th>
                            <th>Group Name</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($permission as $key => $val)
                            <tr>
                                <td>{{ $val->name }}</td>
                                <td>{{ $val->group_name }}</td>
                                <td><a class="" href="{{ route('admin.edit.permission',$val->id) }}"><i class="fas fa-edit"></i></a> / 
                                    
                                    <a class="" href="{{ route('admin.delete.permission',$val->id) }}"><i class="fas fa-trash"></i></a></td>
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
