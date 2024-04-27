@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Permission') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        <a href="{{ route('admin.all.permission') }}">
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
                        
                        <div class="card">
                            <form action="{{ route('admin.update.permission', $permission->id) }}" method="POST">
                                @csrf
                                <div class="card-body col-lg-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control" placeholder="{{ __('Name') }}" value="{{ isset($permission) ? $permission->name : '' }}" >
                                    </div>
                                    @error('name')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                    @enderror
                                </div>
                                <div class="card-body col-lg-8">
                                    <div class="input-group mb-3">

                                        <label>Select Group*</label>
                                        <select type="text" name="group_name" class="form-control">
                                            <option value="">--Select Group--</option>
                                            <option value="category" {{ $permission->group_name == "category" ? "selected" : "" }}>Category</option>
                                            <option value="sub_category" {{ $permission->group_name == "sub_category" ? "selected" : "" }}>Sub Category</option>
                                            <option value="project" {{ $permission->group_name == "project" ? "selected" : "" }}>Project</option>
                                            <option value="question" {{ $permission->group_name == "question" ? "selected" : "" }}>Question</option>
                                            <option value="dashboard" {{ $permission->group_name == "dashboard" ? "selected" : "" }}>Dashboard</option>
                                            <option value="permission" {{ $permission->group_name == "permission" ? "selected" : "" }}>Permission</option>
                                        </select>
                                        @error('name')
                                        <div class="form-group custom-control">
                                            <label class="">{{ $message }}</label>
                                        </div>
                                        @enderror
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
@endsection
