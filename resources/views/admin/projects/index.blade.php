@extends('layouts.app')

@section('content')
    <div class="container-fluid">
       <!-- DataTales Example -->
        <h1 class="h3 mb-2 text-gray-800">{{ __('Project List') }}</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <a href="{{ route('admin.projects.add') }}">
                    <button class="btn btn-blue btn-primary btn-icon btn-icon-standalone btn-icon-standalone-right">
                        <i class="fas fa-arrow-right"></i>
                        <span>Add New Project</span>
                    </button>
                </a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name of Client</th>
                                <th>Address</th>
                                <th>Capacity (AC)</th>
                                <th>Capacity (DC)</th>
                                <th>Project Commissioned</th>
                                <th>No. of Panels</th>
                                <th>Watt-Peak</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Project Head</th>
                                <th>Maintenance Engg</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                       
                        <tbody>
                             @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->name_of_client }}</td>
                                <td>{{ $project->address }}</td>
                                <td>{{ $project->capacity_ac }}</td>
                                <td>{{ $project->capacity_dc }}</td>
                                <td>{{ $project->project_commissioned_on }}</td>
                                <td>{{ $project->no_of_panels }}</td>
                                <td>{{ $project->watt_peak }}</td>
                                <td>{{ $categories[$project->category] }}</td>
                                <td>{{ $subCategories[$project->subcategory] }}</td>
                                <td>{{ $users[$project->project_head] }}</td>
                                <td>{{ $users[$project->maintenance_engg] }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('admin.projects.edit',$project->id) }}"><i class="fas fa-edit"></i></a>
                                    
                                    <a class="btn btn-danger" href="{{ route('admin.projects.delete',$project->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

