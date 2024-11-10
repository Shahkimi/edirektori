@extends('layouts.app')

@section('content')

        <div class="flex-center position-ref full-height">

            <div class="content">
                 <!-- <img src = 'img/pizzahouse.png' width="300" height="300" alt='pizza logo'> -->
                <div class="title m-b-md">
                    SISTEM EDIREKTORI JABATAN KESIHATAN NEGERI KEDAH
                </div>
                <p class="mssg"> {{ session('mssg') }} </p>
            </div>
        </div>
@endsection 
  

