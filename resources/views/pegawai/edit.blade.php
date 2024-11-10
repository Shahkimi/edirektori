@extends('layouts.app')

@section('content')

<br/>

<div class="container-fluid">

	<form class="bg-light rounded p-4 shadow-lg" action="{{url('/pegawai/edit')}}" method="POST" style="max-width: 500px; margin: auto;">
		@csrf

		<h1 style="text-align:center;">Kemaskini Direktori Pegawai</h1>
		<br/>

		<input type="text" name="id" id="id" class="form-control" value="{{$pegawai->id}}" hidden>

		<label for="nama"> Nama : </label><br/>
		<input type = "text" id = "nama" name="nama" class="form-control" value="{{$pegawai->nama}}">
		<br/>

		<label for="ext"> Ext : </label><br/>
		<input type = "text" id = "ext" name="ext" class="form-control" value="{{$pegawai->ext}}">
		<br/>

		<label for="email"> Emel : </label><br/>
		<input type = "text" id = "email" name="email" class="form-control" value="{{$pegawai->email}}">
		<br/>


		<label for="idjawatan"> Jawatan: </label><br/>
        <select class="form-control btn-sm " name="idjawatan" id = "idjawatan">

            <option value="%">-Semua-</option>

            @foreach($jawatans as $jawatan)
                <option value="{{ $jawatan->id }}" {{ ($jawatan->id == $pegawai->idjawatan)? "selected" : "" }} >{{ $jawatan->jawatan }}</option>
            @endforeach

        </select></th><br/>


		<label for="idgred"> Gred: </label><br/>
        <select class="form-control btn-sm " name="idgred" id = "idgred">

            <option value="%">-Semua-</option>

            @foreach($greds as $gred)
                <option value="{{ $gred->id }}" {{ ($gred->id == $pegawai->idgred)? "selected" : "" }} >{{ $gred->gred }}</option>
            @endforeach

        </select></th><br/>

		<label for="idbahagian"> Bahagian: </label><br/>
        <select class="form-control btn-sm " name="idbahagian" id = "idbahagian">

            <option value="%">-Semua-</option>

            @foreach($bahagians as $bahagian)
                <option value="{{ $bahagian->id }}" {{ ($bahagian->id == $pegawai->idbahagian)? "selected" : "" }} >{{ $bahagian->bahagian }}</option>
            @endforeach

        </select></th><br/>

		<label for="idunit"> Unit: </label><br/>
        <select class="form-control btn-sm " name="idunit" id = "idunit">

            <option value="%">-Semua-</option>

            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ ($unit->id == $pegawai->idunit)? "selected" : "" }} >{{ $unit->unit }}</option>
            @endforeach

        </select></th><br/><br/>

		<div style="text-align: center;">
			<a class="btn btn-outline-primary mb-2" href="javascript:history.back()">Batal</a>
			<input type="submit" value="Simpan" class="btn btn-primary mb-2">
		</div>

	</form >
</div>
@endsection

 <script type="text/javascript">
    jQuery(document).ready(function()
    {
            jQuery('select[name="idbahagian"]').on('change',function() {
                var bahagianID = jQuery(this).val();

	    		//alert(bahagianID);


                if (bahagianID) {
                    jQuery.ajax({
                        url : 'http://apps8.kdh.moh.gov.my/edirektori/public/pegawai/getUnit/'+bahagianID,
                        //url : {{url('/pegawai/getUnit/')}}+bahagianID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            jQuery('select[name="idunit"]').empty();
                            jQuery.each(data, function(key,value) {
                                $('select[name="idunit"]').append('<option value="'+ key +'">'+ value +'</option>')
                            });
                        }
                    });
                }
                else
                {
                    $('select[name="idunit"]').empty();
                }

            });
    });

    </script>
