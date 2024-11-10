@extends('layouts.app')

@section('content')

<br/>

<div class="container-fluid">
	
	<form class="bg-light rounded p-4 shadow-lg" action="{{url('/kawalan/unit')}}" method="POST" style="max-width: 500px; margin: auto;">
		@csrf

		<h1 style="text-align:center;">Tambah unit</h1>
		<br/>

		<label for="unit"> unit: </label><br/>
		<input type = "text" id = "unit" name="unit" class="form-control">
		<br/>

		<label for="idbahagian"> Bahagian: </label><br/>
        <select class="form-control btn-sm " name="idbahagian" id = "idbahagian" class="form-control">
            @foreach($bahagians as $bahagian)
                <option value="{{ $bahagian->id }}">{{ $bahagian->bahagian }}</option>
            @endforeach

        </select></th>
        <br/><br/>


		<div style="text-align: center;">
			<a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
			<input type="submit" value="Simpan" class="btn btn-primary mb-2">
		</div>

	</form >
</div>
@endsection

