@extends('layouts.app')

@section('content')

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">{{ __('General check points') }}</h1>
            <div class="row">
                <div class="col-lg-12">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-primary alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            {{ $message }}
                        </div>
                    @endif
                    <div class="card">
                        <form action="{{ route('admin.general-check-points.update', $generalCheckPoints->id) }}" method="POST">
                            @csrf
                            <div class="card card-warning">
                                <div class="card-header">
                                    <h3 class="card-title">General Elements</h3>
                                </div>
                              <!-- /.card-header -->
                                <div class="card-body">
                                   <div class="row">
                                    <div class="col-lg-6">
                                        <label>Select Category*</label>
                                        <select type="text" name="category_id" id="categoryName" class="form-control">
                                            <option value="">--Select Category--</option>
                                            @if($categories)
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $generalCheckPoints->category_id  ? 'selected' : ''}}>{{$category->name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('name')
                                        <div class="form-group custom-control">
                                            <label class="">{{ $message }}</label>
                                        </div>
                                        @enderror
                                    </div>
                                
                                    <div class="col-lg-6">
                                            <label>Add Sub Category*</label>
                                        <div class="input-group mb-3">
                                            <select type="text" name="sub_category_id" id="subCategory" class="form-control">
                                            <option value="{{ $generalCheckPoints->sub_category_id }}">{{ $subCategories[$generalCheckPoints->sub_category_id] }}</option>
                                            </select>
                                        </div>
                                        @error('sub_category_name')
                                        <div class="form-group custom-control">
                                            <label class="">{{ $message }}</label>
                                        </div>
                                        @enderror
                                    </div>
                                      <div class="col-sm-6">
                                         <!-- text input -->
                                         <div class="form-group">
                                            <label>Sr. No.</label>
                                            <input type="text" name="sr_no" value="{{ $generalCheckPoints->sr_no }}" class="form-control" placeholder="Sr. No.">
                                         </div>
                                        @error('sr_no')
                                        <div class="form-group custom-control">
                                            <label class="">{{ $message }}</label>
                                        </div>
                                        @enderror
                                      </div>
                                      <div class="col-sm-6">
                                         <div class="form-group">
                                            <label>Check Points Question</label>
                                            <input type="text" name="check_points_question" class="form-control" value="{{ $generalCheckPoints->check_points_question }}" placeholder="Check Points Question">
                                         </div>
                                        @error('check_points_question')
                                        <div class="form-group custom-control">
                                            <label class="">{{ $message }}</label>
                                        </div>
                                        @enderror
                                      </div>
                                   </div>
                                   <div class="row">
                                      <div class="col-sm-6">
                                        <label>Frequency</label>
                                         <!-- textarea -->
                                         <div class="input-group mb-3">
                                            <select type="text" name="frequency" class="form-control">
                                                <option value="">--Select Frequency--</option>
                                                @if($frequency)
                                                    @foreach($frequency as $key => $val)
                                                    <?php $dash=''; ?>
                                                    <option value="{{ $key }}"  {{$key == $generalCheckPoints->frequency  ? 'selected' : ''}}>{{$val}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        @error('frequency')
                                        <div class="form-group custom-control">
                                            <label class="">{{ $message }}</label>
                                        </div>
                                        @enderror
                                      </div>
                                      
                                   </div>
                                </div>
                              <!-- /.card-body -->
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

@endsection
<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>

$(document).ready(function () {
    $('#categoryName').change(function (e) {
        var cat_id = e.target.value;
        console.log(cat_id);
        $.ajax({
           type:"POST",
           url:"{{ route('admin.general-check-points.getSubCategoryAjax') }}",
           data: {
               cat_id: cat_id,
               _token: $('meta[name="csrf-token"]').attr('content'),
            },
           
           success:function (data) {
            $('#subCategory').empty();
            $.each(data.subcategories,function(index,subcategory){
                $('#subCategory').append('<option value="'+index+'">'+subcategory+'</option>');
            })
           }
       })
    });
});
</script>