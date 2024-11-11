
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-auto">

        <form action="{{url('/pegawai/search')}}" method="Get" id="search">
            @csrf

            <div class="form-group">
                <h2>CARIAN PEGAWAI</h2>
            </div>

            <div class="form-group">
                <label for="nama">Nama : </label>
                <input type="text" class="form-control" name="nama"  form="search">
            </div>

            <div class="form-group">

                <label for="bahagian"> Bahagian : </label><br/>
                <select class="form-control btn-sm " name="bahagian" id="bahagian" form="search">
                    <option value="%">-Semua-</option>

                    @foreach($bahagians as $bahagian)
                        <option value="{{ $bahagian->id }}">{{ $bahagian->bahagian }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="unit"> Unit : </label><br/>
                <select class="form-control btn-sm " name="unit" id = "unit" form="search">
                    <option value="%">-Semua-</option>

                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit }}</option>
                    @endforeach

                </select>
            </div>

            <div style="text-align: center;">
                <input class="btn btn-primary" type="submit" name="" value="Carian" form="search">
            </div>


        </form>

    </div>
</div>

@endsection


    <script type="text/javascript">
    jQuery(document).ready(function()
    {
            jQuery('select[name="bahagian"]').on('change',function() {
                var bahagianID = jQuery(this).val();

                if (bahagianID) {
                    jQuery.ajax({
                         url : 'http://apps8.kdh.moh.gov.my/edirektori/public/pegawai/getUnit/'+bahagianID,
                        //url : {{url('/pegawai/getUnit/')}}+bahagianID,
                        type : "GET",
                        dataType : "json",
                        success:function(data)
                        {
                            jQuery('select[name="unit"]').empty();
                            $('select[name="unit"]').append('<option value="%">-Sila Pilih-</option>')
                            jQuery.each(data, function(key,value) {
                                $('select[name="unit"]').append('<option value="'+ key +'">'+ value +'</option>')
                            });
                        }
                    });
                }
                else
                {
                    $('select[name="unit"]').empty();
                }

            });
    });

    </script>

