

@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">
                    <table class="table" id="sticker_table">
                        <thead class="thead-dark">
                            <tr>    
                                <th scope="col">#</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Username</th>
                                <th scope="col">Bahagian</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Tindakan</th>
                            </tr>
                            <tr>
                                <form action="{{url('/admin/users/search')}}" method="Get" id="search">
                                @csrf
                                <th scope="col"></th>
                                <th scope="col"><input class="form-control" type="text" name="name" form="search"></th>
                                <th scope="col"><input class="form-control" type="text" name="email" form="search"></th>
                                <th scope="col">
                                    <select class="form-control" name="bahagian" id = "bahagian" form="search">
                                        <option value="%">-Sila Pilih-</option>
                                        @foreach($bahagian as $a)
                                            <option value="{{$a->id}}">{{$a->id}}.{{$a->bahagian}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th scope="col">
                                    <select class="form-control" name="role" id = "role" form="search">
                                        <option value="%">-Sila Pilih-</option>
                                        @foreach($roles as $b)
                                            <option value="{{$b->id}}">{{$b->name}}</option>
                                        @endforeach
                                    </select>
                                </th>
                                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
                                </caption>
                            </form>
                        </tr>
                        </thead>
                        <tbody>
                            {{ $i = 1 }}
                            @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->bahagian}}</td>
                                <td>{{$user->role}}</td>
                                <td>
                                    @can('edit-users')
                                        <a class="fa fa-edit-o" href="{{route('admin.users.edit', $user->id)}}">Edit</a>
                                    @endcan

                                    @can('delete-users')
                                        <form action="{{route('admin.users.destroy', $user->id)}}" method="POST" class="float-left">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <button onclick="return confirm('Delete {{$user->name}}')" type="submit" class="fa fa-trash-o">Delete</button>
                                        </form>
                                    @endcan 
                                </td> 

                            </tr>
                            @endforeach
                        </tbody>
                    </table>  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
