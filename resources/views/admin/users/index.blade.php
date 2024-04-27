@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- <h6 class="font-weight-bold text-primary">Users Table</h6> -->
                <span style="float: right;"><a href="{{ route('admin.users.add') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add New User</span>
                    </button></span>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Signature</th>
                            <th>Assign Project</th>
                            <th>Created at</th>
                            <th>Updated in</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    @if($user->signature_upload != "")
                                        <img src="{{ asset('signature/'.$user->signature_upload)}}" alt="Image" width="80">
                                    @endif
                                  </td>
                                <td>
                                   
                                    <span class="badge badge-pill bg-danger">{{ $roles[$user->roles] }}</span>
                                    
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at->diffForhumans() }}</td>
                                <td><a class="" href="{{ route('admin.users.edit',$user->id) }}"><i class="fas fa-edit"></i></a> / 
                                    
                                    <a class="" href="{{ route('admin.users.delete',$user->id) }}"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
