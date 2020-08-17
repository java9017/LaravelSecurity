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
                        <h4 class="float-left">Edit User</h4>
                        <div class="card-tools">
                            
                        </div>
                    </div>
                    <div class="card-body">
                        @include('app.custom.message')

                        <form action="{{ route('user.update', $user->id) }}" method="POST" id="form-user">
                            @csrf
                            @method('PUT')

                            <div class="container">
                                <h5>Required Data</h5>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" 
                                        placeholder="Name" value="{{ old('name', $user->name) }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" id="email" 
                                        placeholder="Email" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="form-group">
                                    @php
                                        // dd($user->roles);
                                    @endphp
                                    <select name="roles" id="roles" class="form-control">
                                        @foreach ($roles as $key => $role)
                                            @if ($key == 0)
                                                <option value="null" 
                                                    @empty($user->roles->toArray())
                                                        selected
                                                    @endempty  
                                                disabled>Select Role</option>
                                            @endif   

                                            <option value="{{ $role->id }}"
                                                @if(!empty($user->roles->toArray()))
                                                    @if ($role->name == $user->roles->first()->name)
                                                        selected
                                                    @endif
                                                @endif
                                            >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-md btn-success" type="submit" value="Save" form="form-user">
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
