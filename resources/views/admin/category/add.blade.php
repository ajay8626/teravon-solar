@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Category') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        <a href="{{ route('admin.categories.index') }}">
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
                            if(isset($category) && !empty($category)){
                                $url = route('admin.categories.update', $category->id);
                            }else{
                                $url = route('admin.categories.store');
                            }
                        ?>
                        <div class="card">
                            <form action="<?=$url; ?>" method="POST">
                                @csrf
                                <div class="card-body col-lg-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ __('Category Name') }}" value="{{ isset($category) ? $category->name : ''  }}" >
                                    </div>
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
