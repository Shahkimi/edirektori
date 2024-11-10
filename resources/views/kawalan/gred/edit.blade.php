@extends('layouts.app')

@section('content')

<br/>

<div class="container-fluid">
	
	<form class="bg-light rounded p-4 shadow-lg" action="{{url('/kawalan/gred/edit')}}" method="POST" style="max-width: 500px; margin: auto;">
		@csrf

		<h1 style="text-align:center;">Kemaskini gred</h1>
		<br/>

		<input type="text" name="id" id="id" class="form-control" value="{{$gred->id}}" hidden>

		<label for="gred"> gred: </label><br/>
		<input type = "text" id = "gred" name="gred" class="form-control" value="{{$gred->gred}}">
		<br/>

		<div style="text-align: center;">
			<a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
			<input type="submit" value="Simpan" class="btn btn-primary mb-2">
		</div>

	</form >
</div>
@endsection

