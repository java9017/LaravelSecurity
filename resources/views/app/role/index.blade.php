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
                        <h4 class="float-left">List of Roles</h4>
                        <div class="card-tools">
                            <a class="btn btn-sm btn-primary" href="{{ route('role.create') }}">Create</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @include('app.custom.message')
                        
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slug</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Full Access</th>
                                    <th scope="col">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <style>
                                    .dropdown-item {
                                        font-size: .9em;
                                        padding: 0 .6rem;
                                    }

                                    button:focus {
                                        outline: none;
                                        border:0px;
                                    }
                                </style>
                                @foreach ($roles as $index => $role)
                                    <tr>
                                        <td scope="row">{{ $role->id }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->slug }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role['full-access'] }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="roleoption" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Role
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="roleoption">
                                                    <a class="dropdown-item" href="{{ route('role.show', $role->id) }}">Show</a>
                                                    <a class="dropdown-item" href="{{ route('role.edit', $role->id) }}">Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('role.destroy', $role->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item b-0">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
    
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
