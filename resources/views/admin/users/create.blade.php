
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Daftar Pengguna</div>

                <div class="card-body">
                  <form action="{{route('admin.users.store')}}" method="POST">
                    <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="" required  autofocus>

                            </div>
                        </div>
                    <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="" required autofocus>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                      @csrf
                  <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">Bahagian</label>

                            <div class="col-md-6">
                               <select class="form-control" name="bahagian" required>
                                <option>-Pilih Bahagian-</option>
                                  @foreach($bahagian as $a)
                                    <option value="{{$a->id}}">{{$a->bahagian}}</option>
                                  @endforeach
                               </select>
                            </div>
                        </div>
                        @csrf
                      
                      <div class="form-group row">
                      <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>
                      <div class="col-md-6">
                      @foreach($roles as $role)
                        <div class="form-check">
                            <input type="radio" name="roles" value="{{$role->id}}">
                            <label>{{$role->name}}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                      <button type="submit" class="btn btn-primary">
                          Hantar
                      </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
