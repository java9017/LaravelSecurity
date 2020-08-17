@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    {{-- <h1 class="m-0 text-dark"></h1> --}}
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="float-left">Create Roles</h4>
                        <div class="card-tools">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        @include('app.custom.message')

                        <form action="{{ route('role.store') }}" method="POST" id="form-role">
                            @csrf
                            <div class="container">
                                <h5>Required Data</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" 
                                        placeholder="Name" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="slug" id="slug" 
                                        placeholder="Slug" value="{{ old('slug') }}">
                                </div>
                                <div class="form-group">
                                    <textarea name="description" id="description" rows="3"
                                        class="form-control" placeholder="Description">
                                            {{ old('description') }}
                                    </textarea>
                                </div>
                                <hr>

                                <h5>Full Access</h5>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="fullaccessyes" name="full-access" value="yes" 
                                        {{ old('full-access') == 'yes' ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="fullaccessyes">Yes</label>

                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" id="fullaccessno" name="full-access" value="no" 
                                        {{ old('full-access') == 'no' ? 'checked' : old('full-access') ?: 'checked'}}>
                                    <label class="custom-control-label" for="fullaccessno">No</label>
                                </div>
                                <hr>
                                
                                <h5>Permission List</h5>
                                @foreach ($permissions as $permission)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" 
                                            id="permission_{{ $permission->id }}" value="{{ $permission->id }}" name="permission[]" 
                                            {{ is_array(old('permission')) && in_array($permission->id, old('permission')) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="permission_{{ $permission->id }}">
                                            {{ $permission->name }}  <em> ({{ $permission->description }})</em>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-md btn-success" type="submit" value="Save" form="form-role">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
