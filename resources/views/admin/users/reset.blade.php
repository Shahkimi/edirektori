@extends('layouts.app')

@section('content')

<br/>

<div class="container-fluid">
    
    <form class="bg-light rounded p-4 shadow-lg" action="{{url('/admin/users/reset')}}" method="POST" style="max-width: 500px; margin: auto;">
        @csrf

        <h1 style="text-align:center;">Reset Password </h1>
        <br/>

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

        <label for="current"> Current Password : </label><br/>
        <input type = "password" id = "current_password" name="current_password" class="form-control">
        <br/>

        <label for="new_password"> New Password : </label><br/>
        <input type = "password" id = "new_password" name="new_password" class="form-control">
        <br/>

        <label for="c_new_password"> Confirm New Password : </label><br/>
        <input type = "password" id = "c_new_password" name="c_new_password" class="form-control">
        <br/>

        <div style="text-align: center;">
            <a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
            <input type="submit" value="Simpan" class="btn btn-primary mb-2">
        </div>

    </form >
</div>
@endsection

