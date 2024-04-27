@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Users') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="p-5">
                        <div class="text-left">
                            <h2 class="h4 text-gray-900 mb-4">{{ __('Project Information') }}</h2>
                        </div>
                        <form class="user" action="{{ route('admin.projects.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="company_name" class="form-control @error('name') is-invalid @enderror" id="exampleInputName"
                                       placeholder="{{ __('Company Name') }}">
                            </div>
                            @error('name')
                            <div class="form-group custom-control">
                                <label class="">{{ $message }}</label>
                            </div>
                            @enderror


                            <div class="form-group">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputEmail"
                                       placeholder="{{ __('Address') }}"></textarea>
                            </div>
                            @error('address')
                            <div class="form-group custom-control">
                                <label class="">{{ $message }}</label>
                            </div>
                            @enderror
                            <div class="form-group input-group">
                                <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" id="exampleInputCategory"
                                       placeholder="{{ __('Capacity') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">KW</span>
                                </div>
                            </div>
                            @error('capacity')
                            <div class="form-group custom-control">
                                <label class="">{{ $message }}</label>
                            </div>
                            @enderror

                            <div class="form-group">
                                <div class="input-group-append" data-target="#datapicker" data-toggle="datapicker">
                                <div class="input-group date" data-target-input="nearest">
                                    <input type="text" name="project_date" class="form-control datetimepicker-input @error('project_date') is-invalid @enderror" id="datepicker" data-target="#datapicker" placeholder="{{ __('Select Date') }}">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>

                                </div>
                            </div>

                              <!-- <div class="input-group">
                                <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" id="datepicker" data-mask>
                                <div class="input-group-prepend">

                                  <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                              </div> -->
                                
                            </div>
                            <div class="text-left">
                                <h2 class="h4 text-gray-900 mb-4">{{ __('Maintenance') }}</h2>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Category</label>
                                    @if($categorieName)
                                        @foreach($categorieName as $key => $category)
                                    <div class="custom-control custom-checkbox">
                                          <input class="custom-control-input" name="categories_id[]" value="{{ $key }}" type="checkbox" id="customCheckbox{{ $key }}">
                                          <label for="customCheckbox{{ $key }}" class="custom-control-label">{{ $key }}.0 {{$category}}</label>
                                    </div>
                                        @endforeach
                                    @endif
                                    @error('categories')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label>Sub Category</label>
                                    @if($categorieName)
                                        @foreach($categorieName as $key => $category)
                                        <div class="custom-control">
                                            <label class="">{{$key}}.0 {{$category}}</label>
                                        </div>
                                            <ul class="Checkbox-child">
                                        @php
                                            $i = 1;
                                            $currentLevel = 0;
                                        @endphp
                                        @foreach($sub_categories as $subkey => $subcategory)
                                            @if($key === $subcategory->category_id)
                                              <li>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" name="subcategories_id[]" value="{{ $subcategory->id }}" type="checkbox" id="subCheckbox{{ $subkey }}">
                                                    <label for="subCheckbox{{ $subkey }}" class="custom-control-label">{{$key}}.{{$i}} {{ $subcategory->sub_category_name }}</label>
                                                </div>
                                              </li>
                                            @endif
                                            @php
                                                if($i === $subcategory->category_id){
                                                    $i = 1;
                                                }
                                                $i++;
                                            @endphp
                                        @endforeach
                                            </ul>
                                        @endforeach
                                    @endif
                                    @error('sub_categories')
                                    <div class="form-group custom-control">
                                        <label class="">{{ $message }}</label>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Submit') }}
                            </button>
                        </form>
                    </div>
                        
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
<style>
    ul {
      list-style-type: none;
    }
    .datepicker td,th{
        text-align: center;
        padding: 8px 12px;
        font-size: 14px;
    }
</style>
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
  $(function () {
    $('#datepicker').datepicker();
  });
</script>