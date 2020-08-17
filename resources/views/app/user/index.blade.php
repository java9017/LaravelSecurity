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
                        <h4 class="float-left">List of Users</h4>
                        <div class="card-tools">
                            {{-- <a class="btn btn-sm btn-primary" href="{{ route('role.create') }}">Create</a> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        @include('app.custom.message')
                        
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role(s)</th>
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
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td scope="row">{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ isset($user->roles[0]) ? $user->roles[0]->name : '' }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="useroption" 
                                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> User
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="useroption">
                                                    <a class="dropdown-item" href="{{ route('user.show', $user->id) }}">Show</a>
                                                    <a class="dropdown-item" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
    
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
