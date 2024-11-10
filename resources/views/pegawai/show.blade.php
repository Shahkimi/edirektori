@extends('layouts.app')

@section('content')

<br/>

<div class="container-fluid">

 @foreach($pegawai as $peg)
	<form class="bg-light rounded p-4 shadow-lg" action="{{ route('pegawai.destroy',$peg->id) }}" method="POST" style="max-width: 500px; margin: auto;">
		@csrf

    	@method('DELETE')

		<h1 style="text-align:center;">{{ $ftajuk }} Pegawai</h1>
		<br/>

		<label for="nama"> <b>Nama :  </b> {{ $peg->nama }} </label> <br/><br/>
		<label for="ext"> <b>Ext :  </b> {{ $peg->ext }} </label> <br/><br/>
		<label for="emel"> <b>Emel :  </b> {{ $peg->email }} </label> <br/><br/>
		<label for="jawatan"> <b>Jawatan :  </b> {{ $peg->jawatan }} </label> <br/><br/>
		<label for="bahagian"> <b>Bahagian :  </b> {{ $peg->bahagian }} </label> <br/><br/>
		<label for="unit"> <b>Unit :  </b> {{ $peg->bahagian }} </label><br/><br/>

		<div style="text-align: center;">
			<a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
			@if( $ftajuk <> 'View')
				<input type="submit" value="Remove" class="btn btn-primary mb-2">
			@endif
		</div>
	</form>	
@endforeach
</div>
 
@endsection

 