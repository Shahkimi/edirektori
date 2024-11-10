@extends('layouts.app')

@section('content')

<br/>

<div class="container-fluid">

	<form class="bg-light rounded p-4 shadow-lg" action="{{ route('kawalan.destroy_bahagian',$bahagian->id) }}" method="POST" style="max-width: 500px; margin: auto;">
		@csrf

    	@method('DELETE')
		<h1 style="text-align:center;">Delete bahagian</h1>
		<br/>

		<label for="bahagian"> <b>bahagian :  </b> {{ $bahagian->bahagian }} </label>
		<br/><br/>

		<div style="text-align: center;">
			<a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
			<input type="submit" value="Remove" class="btn btn-primary mb-2">
		</div>
	</form>	
</div>
 
@endsection

 