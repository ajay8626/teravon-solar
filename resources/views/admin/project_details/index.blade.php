@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Projects List</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <span style="float: right;">
                    <a href="{{ route('admin.project_details.add') }}">
                        <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                            <i class="fas fa-arrow-right"></i>
                            <span>Add New Project</span>
                        </button>
                    </a>
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Address</th>
                            <th>Capacity</th>
                            <th>Project Date</th>
                            <th>Category Name</th>
                            <th>SubCategory</th>
                            <th>Created at</th>
                            <th>Updated in</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        
                        <tbody>
                         @foreach($project_details as $project)
                         
                            <tr>
                                <td>{{ $project->company_name }}</td>
                                <td>{{ $project->address }}</td>
                                <td>{{ $project->capacity }}Kw</td>
                                <td>{{ $project->project_date }}</td>
                                <td><ul>
                                <?php
                                    $categoryId = explode(',', $project->categories_id);
                                    foreach($categoryId as $key => $val){  ?>
                                    <li>{{ $categorieName[$val] }}</li>
                                <?php } ?>
                                </td></ul>
                                <td><ul>
                                <?php
                                    $subcategoryId = explode(',', $project->subcategories_id);
                                    foreach($subcategoryId as $key => $val){  ?>
                                    <li>{{ $subCategoryName[$val] }}</li>
                                <?php } ?>
                                </td></ul>
                                <td>{{ $project->created_at }}</td>
                                <td>{{ $project->updated_at }}</td>
                                <td><a class="" href="{{ route('admin.project_details.edit',$project->id) }}"><i class="fas fa-edit"></i></a> / 
                                    
                                    <a class="" href="{{ route('admin.project_details.delete',$project->id) }}"><i class="fas fa-trash"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                     $projects->links();

                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
