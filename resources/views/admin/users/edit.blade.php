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
                            <a href="{{ route('admin.users.index') }}">
                                <button class="btn btn-warning btn-icon btn-icon-standalone btn-icon-standalone-right">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Back</span>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">{{ __('Create an Account!') }}</h1>
                        </div>
                        <form class="user" action="{{ route('admin.users.update', $users->id) }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <input type="text" name="name" class="form-control" value="{{ isset($users) ? $users->name : ''  }}" id="exampleInputName"
                                       placeholder="{{ __('Name') }}">
                            </div>
                           <div class="form-group">
                                <input type="email" name="email" value="{{ isset($users) ? $users->email : ''  }}" class="form-control" id="exampleInputEmail"
                                       placeholder="{{ __('Email Address') }}">
                            </div>
                            <div class="form-group">
                                <input type="text" name="mobile" value="{{ isset($users) ? $users->mobile : ''  }}" class="form-control" id="exampleInputName"
                                       placeholder="{{ __('Mobile') }}">
                            </div>
                            <div class="form-group">
                                <select type="text" name="role_id" id="roles" class="form-control">
                                    <option value="">--Select Role--</option>

                                    @if($roles)
                                        @foreach($roles as $key => $role)
                                            <option value="{{$role->id}}"  {{$role->id == $users->roles  ? 'selected' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" id="customFile" value="{{ isset($users) ? $users->signature_upload : ''  }}" name="signature_upload" data-allowed-file-extensions="jpg png jpeg">
                                </div>
                                <?php
                                    if($users->signature_upload != ""){ ?>
                                        <img src="{{ asset('signature/'.$users->signature_upload)}}" alt="Image" width="80">
                                  <?php  }
                                ?>
                                
                            </div>

                            <div class="form-group">
                              <div class="select2-purple">
                                <select class="select2" name="assign_project[]" multiple="multiple" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;">
                                  @if(!empty($category))
                                  
                                    @foreach($category as $key => $val)
                                        <option value="{{ $key }}"  @if(isset($categoryId) && in_array($key,$categoryId)) selected @endif   >{{$val}}</option>
                                    @endforeach
                                  @endif

                                </select>
                              </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                {{ __('Update Account') }}
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
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
//Initialize Select2 Elements
    $(document).ready(function () {
        $('.select2').select2();
    });

</script>