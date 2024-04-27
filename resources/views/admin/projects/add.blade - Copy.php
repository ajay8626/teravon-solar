@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
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
                        <?php
                            if(isset($project) && !empty($project)){
                                $url = route('admin.projects.update', $project->id);
                            }else{
                                $url = route('admin.projects.store');
                            }
                        ?>
                        <div class="card">
                            <form action="<?=$url; ?>" method="POST">
                                @csrf
                                <div class="card-body col-lg-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="project_name" class="form-control" placeholder="{{ __('Project Name') }}" value="{{ isset($project) ? $project->project_name : ''  }}" >
                                    </div>
                                    @error('project_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <select type="text" name="project_duration" class="form-control">
                                            <option value="">--Select Project Duration--</option>
                                            @foreach($durations as $key => $duration)
                                                <option value="{{ $key }}">{{ $duration }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('project_duration')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <select type="text" name="project_assign" class="form-control">
                                            <option value="">--Project Assign to User--</option>
                                            @foreach($users as $key => $user)
                                                <option value="{{ $key }}">{{ $user }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('project_assign')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="input-group mb-3">
                                        <input type="date" name="project_assign_date" class="form-control" placeholder="{{ __('Assign Date') }}" value="{{ isset($project) ? $project->project_assign_date : ''  }}" >
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
