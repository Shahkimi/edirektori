
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User {{$user->name}}</div>

                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
        
                <div class="card-body">
                  <form action="{{route('admin.users.update', $user)}}" method="POST">
                    
                    <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Username</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                    <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Bahagian</label>
                            <div class="col-md-6">
                               <select class="form-control" name="bahagian" id = "bahagian" required>
                                  @foreach($bahagians as $a)
                                    <option value="{{$a->id}}" {{ ($a->id ==  $bahagian_user)? "selected" : "" }} >{{$a->bahagian}}</option>
                                  @endforeach
                               </select>
                            </div>
                    </div>

                      @csrf
                      {{method_field('PUT')}}
                    <div class="form-group row">
                            <label for="roles" class="col-md-3 col-form-label text-md-right">Roles</label>
                            <div class="col-md-6">
                            @foreach($roles as $role)
                              <div class="form-check">
                                  <input type="radio" name="roles[]" value="{{$role->id}}" @if($user->roles->pluck('id')->contains($role->id))checked @endif>
                                  <label>{{$role->name}}</label>
                              </div>
                            @endforeach
                          </div>
                    </div>

                    <div class="form-group row">
                      <label for="new_password" class="col-md-3 col-form-label text-md-right">New Password</label>
                      <div class="col-md-6">
                          <input type = "password" id = "new_password" name="new_password" class="form-control">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="confirm_new_password" class="col-md-3 col-form-label text-md-right">Confirm New Password</label>
                      <div class="col-md-6">
                          <input type = "password" id = "confirm_new_password" name="confirm_new_password" class="form-control">
                      </div>
                    </div>

                  <div style="text-align: center;">
                    <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary mb-2">
                  </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
