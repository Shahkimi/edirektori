
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-auto">

        @can('add-users')
            <a href="{{ route('pegawai.create') }}" class="btn-primary btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Tambah Pegawai </a><br/> <br/>
        @endcan
        <div class="table-responsive-lg">
        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Ext</th>
                <th scope="col">Email</th>
                <th scope="col">Jawatan / Gred</th>
                <th scope="col">Bahagian</th>
                <th scope="col">Unit</th>
                <th scope="col">Tindakan</th>
            </tr>

            <tr>
                <form action="{{url('/pegawai/search')}}" method="Get" id="search">
                @csrf
                <th scope="col"></th>

                <th scope="col"><input class="form-control" type="text" name="nama" value = "{{ $fnama }}" form="search"></th>
                <th scope="col" width="5%"><input class="form-control" type="text" name="ext"  form="search"></th>
                <th scope="col"><input class="form-control" type="text" name="email"  form="search"></th>

                <th scope="col">
                <select class="form-control btn-sm " name="jawatan" form="search">
                    <option value="%">-Semua-</option>

                    @foreach($jawatans as $jawatan)
                        <option value="{{ $jawatan->id }}" >{{ $jawatan->jawatan }}</option>
                    @endforeach

                <th scope="col">
                <select class="form-control btn-sm " name="bahagian" id="bahagian" form="search">
                    <option value="%">-Semua-</option>

                    @foreach($bahagians as $bahagian)
                        <option value="{{ $bahagian->id }}" {{ ($bahagian->id == $fbahagian)? "selected" : "" }} >{{ $bahagian->bahagian }}</option>
                    @endforeach

                </select></th>

                <th scope="col">
                <select class="form-control btn-sm " name="unit" id = "unit" form="search">
                    <option value="%">-Semua-</option>
                </select></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
                </form>
            </tr>


            @foreach($pegawais as $key=>$pegawai)
                <tr>
                    <td>{{$pegawais->firstItem() + $key}}.</td>
                    <td>{{$pegawai->nama}}</td>
                    <td style="text-align: center">{{$pegawai->ext}}</td>
                    <td>{{$pegawai->email}}</td>
                    <td>{{$pegawai->jawatan}} {{$pegawai->gred}} </td>
                    <td>{{$pegawai->bahagian}}</td>
                    <td>{{$pegawai->unit}}</td>
                      <td>
                        @can('edit-users')
                        <a class="btn btn-warning float-left" href="{{route('pegawai.edit', $pegawai->id)}}">Edit</a>
                        @endcan
                        @can('delete-users')
                        <form action="{{url('/pegawai/'.$pegawai->id)}}" method="POST" class="float-left">
                            @csrf
                            {{method_field('DELETE')}}
                            <button onclick="return confirm('Delete {{$pegawai->nama}}')" type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        @endcan

                    </td>
                </tr>
            @endforeach

        </table>

         {{ $pegawais->links() }}

        </div>
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
                         url : 'http://apps3.kdh.moh.gov.my/pizzahouse/public/pegawai/getUnit/'+bahagianID,
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

