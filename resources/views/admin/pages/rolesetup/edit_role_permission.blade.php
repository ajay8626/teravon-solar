@extends('layouts.app')

@section('content')
    <div class="">
        <!-- Responsive Table -->
        <div class="container row">
            <div class="col-lg-12">
                <h1 class="h3 mb-2 text-gray-800">{{ __('Edit Roles in Permission') }}</h1>
                <!-- Default Card Example -->
                <div class="card mb-8">
                    <div class="card-header">
                        <div class="title-env">
                        <a href="{{ route('admin.all.roles') }}">
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
                            <form action="{{ route('admin.update.roles.permission',$role->id) }}" method="POST">
                                @csrf
                                <div class="card-body col-lg-8">
                                    <div class="input-group mb-3">
                                        <h3>{{ $role->name }}</h3>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkDefaultMain">
                                        <label class="form-check-label" for="checkDefaultMain">Permission All</label>
                                    </div>
                                    <hr/>
                                    @foreach($permission_groups as $key => $group)
                                    <div class="row">
                                        <div class="col-3">
                                            @php
                                                $permissions = App\Models\User::getPermissionByGroupName($group->group_name);
                                                
                                            @endphp
                                            <div class="form-check">
                                                <input type="checkbox" name="group_id" class="form-check-input" id="checkGroup{{$key}}" {{ App\Models\User::roleHasPermission($role, $permissions) ? "checked": "" }} >
                                                <label class="form-check-label" for="checkGroup{{$key}}">{{ $group->group_name }}</label>
                                            </div>
                                        </div>
                                        <div class="col-9">
                                        
                                        @foreach($permissions as $permission)
                                            <div class="form-check mb-2">
                                                <input type="checkbox" name="permission[{{ $permission->id }}]" class="form-check-input" id="checkDefault{{ $permission->id }}" value="{{ $permission->id }}" {{ $role->hasPermissionTo($permission->name) ? 'checked':'' }}>
                                                <label class="form-check-label" for="checkDefault{{ $permission->id }}">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                        <br>
                                        </div>
                                    </div>
                                    @endforeach
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
<style type="text/css">
    .form-check-label{
        text-transform: capitalize;
    }
</style>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
    $('#checkDefaultMain').click( function(){
        if($(this).is(':checked')){
            $('input[type=checkbox]').prop('checked', true);
        }else{
            $('input[type=checkbox]').prop('checked', false);
        }
    });
</script>
@endsection
