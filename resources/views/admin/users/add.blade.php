@extends('layouts.app')

@section('content')
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/validate.min.js') }}"></script>
<script src="{{ asset('js/additional-methods.js') }}"></script>
<div class="container">
        <!-- Responsive Table -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Add Users') }}</h1>
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
                        <form class="user" id="userForm" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="input-group mb-3">
                                <input type="text" name="name" id="exampleInputName" class="form-control" placeholder="{{ __('Name') }}" value="" >
                            </div>
                            <span id="name_error"></span>
                            
                            <div class="input-group mb-3">
                                <input type="email" name="email" id="exampleInputEmail" class="form-control" placeholder="{{ __('Email Address') }}" value="" >
                            </div>
                            
                            <div class="input-group mb-3">
                                <input type="text" name="mobile" id="exampleInputMobile" class="form-control" placeholder="{{ __('Mobile') }}" value="" >
                            </div>
                            
                            <div class="form-group">
                                <select type="text" name="role_id" id="roles" class="form-control">
                                    <option value="">--Select Role--</option>
                                    @if($roles)
                                        @foreach($roles as $key => $role)
                                            <option value="{{$role->id}}" >{{$role->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" id="customFile" name="signature_upload" data-allowed-file-extensions="jpg png jpeg">
                                </div>
                            </div>                    
                            <div class="form-group row">
                                <div class="col-sm-6 input-group mb-3">
                                    <input type="password" name="password" id="exampleInputPassword" class="form-control" placeholder="{{ __('Password') }}" value="" >
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" id="exampleRepeatPassword" class="form-control" placeholder="{{ __('Repeat Password') }}" value="" >
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary btn-user btn-block" value="{{ __('Register Account') }}">
                        </form>
                    </div>
                        
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.btn-user').on('click', function(){
        
        if($('#exampleInputName').val() == ""){
            $('#name_error').html('Please enter name').css('color', 'red');
            $('#exampleInputName').focus();
            return false;
        }
    });
    
    /*$("#userForm").validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true
                // Add any additional validation rules, e.g., phone number format
            },
            role_id: {
                required: true
            },
            signature_upload: {
                // Add rules for file upload if needed, e.g., file size or type
            },
            password: {
                required: true,
                minlength: 5
            },
            password_confirmation: {
                equalTo: "#exampleInputPassword"
            }
        },
        messages: {
            name: {
                required: "Please enter your full name"
            },
            email: {
                required: "Please enter an email address",
                email: "Please enter a valid email address"
            },
            mobile: {
                required: "Please enter a mobile number"
            },
            role_id: {
                required: "Please select a role"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },
            password_confirmation: {
                equalTo: "Password confirmation does not match"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    }); */
});
</script>

@endsection

