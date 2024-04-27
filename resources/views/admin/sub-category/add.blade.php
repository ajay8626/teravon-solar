@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Add Sub Category') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        <a href="{{ route('admin.sub-categories.index') }}">
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
                            /*if(isset($sub_categories) && !empty($sub_categories)){
                                $url = route('sub-categories.update', $sub_categories->id);
                            }else{
                                $url = route('sub-categories.store');
                            }*/
                        ?>
                        <div class="card">
                            <form action="{{ route('admin.sub-categories.store') }}" method="POST">
                                @csrf
                                <div class="card-body col-lg-8">
                                    <label>Select parent category*</label>
                                    <select type="text" name="category_id" class="form-control">
                                        <option value="">--Select Category--</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                            <?php $dash=''; ?>
                                            <option value="{{$category->id}}" >{{$category->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @error('name')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="card-body col-lg-8">
                                        <label>Add Sub Category*</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="sub_category_name" class="form-control @error('sub_category_name') is-invalid @enderror" placeholder="{{ __('Sub Category Name') }}" value="" >
                                    </div>
                                    @error('sub_category_name')
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
