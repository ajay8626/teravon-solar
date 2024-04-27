@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Project Information') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        
                    </div>
                    </div>
                    <div class="card-body">
                        <?php
                            if(isset($project_details) && !empty($project_details)){
                                $url = route('admin.project_details.update', $project_details->id);
                            }else{
                                $url = route('admin.project_details.store');
                            }
                        ?>
                        <form class="user" action="{{$url}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="company_name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($project_details) ? $project_details->company_name : '' }}" id="exampleInputName"
                                       placeholder="{{ __('Name of Client') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="company_name" class="form-control @error('name') is-invalid @enderror" value="{{ isset($project_details) ? $project_details->company_name : '' }}" id="exampleInputName"
                                       placeholder="{{ __('Company Name') }}">
                            </div>
                            @error('name')
                            <div class="form-group custom-control">
                                <label class="">{{ $message }}</label>
                            </div>
                            @enderror


                            <div class="form-group">
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror" id="exampleInputEmail"
                                       placeholder="{{ __('Address') }}">{{ isset($project_details) ? $project_details->address : '' }}</textarea>
                            </div>
                            @error('address')
                            <div class="form-group custom-control">
                                <label class="">{{ $message }}</label>
                            </div>
                            @enderror
                            <div class="form-group input-group">
                                <input type="text" name="capacity" class="form-control @error('capacity') is-invalid @enderror" value="{{ isset($project_details) ? $project_details->capacity : '' }}" id="exampleInputCategory"
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
                                    <input type="text" name="project_date" value="{{ isset($project_details) ? date('m/d/Y', strtotime($project_details->project_date)) : '' }}" class="form-control datetimepicker-input @error('project_date') is-invalid @enderror" id="datepicker" data-target="#datapicker" placeholder="{{ __('Select Date') }}">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>

                                </div>
                            </div>
                                
                            </div>
                            <div class="text-left">
                                <h2 class="h4 text-gray-900 mb-4">{{ __('Maintenance') }}</h2>
                            </div>
                            <div class="form-group row">
                                <div class="parent-checkbox col-sm-6 mb-3 mb-sm-0">
                                    <label>Category</label>
                                    @if($categorieName)
                                        @foreach($categorieName as $key => $category)
                                    <div class="custom-control custom-checkbox">
                                          <input class="parents custom-control-input" name="categories_id[]" value="{{ $key }}" @if(isset($categoryId) && in_array($key,$categoryId)) checked @endif type="checkbox" id="customCheckbox{{ $key }}">
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
                                <div class="child-checkbox col-sm-6 mb-3 mb-sm-0">
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
                                                    <input class="custom-control-input checkboxChild" name="subcategories_id[]" value="{{ $subcategory->id }}" @if(isset($subcategoriesId) && in_array($subcategory->id,$subcategoriesId)) checked @endif type="checkbox" id="subCheckbox{{ $subkey }}">
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
      $('.child-checkbox input[type=checkbox]').attr('disabled', true);
      $(".parents:checkbox:checked").each(function() {
            var parentIndex = $('.parents').index(this);
            var $relatedSubcategories = $('.child-checkbox ul.Checkbox-child').eq(parentIndex).find('input[type="checkbox"]');
            $relatedSubcategories.prop('disabled', !this.checked);
        });
      $('.parents').change(function() {
        // Find the parent category index
        var parentIndex = $('.parents').index(this);
        // Find the corresponding subcategories for the selected parent category
        var $relatedSubcategories = $('.child-checkbox ul.Checkbox-child').eq(parentIndex).find('input[type="checkbox"]');
        console.log($relatedSubcategories);
        // Enable or disable the related subcategories based on the parent category checkbox state
        $relatedSubcategories.prop('disabled', !this.checked);
    });
  });

</script>