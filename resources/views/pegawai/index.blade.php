<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.app')

@section('content')
    <div class="row justify-content-center m-2">

        <form class="form-inline" action="{{ url('/pegawai/search') }}" method="Get" id="search">
            @csrf

            <div class="form-group">
                <label for="nama" style="font-weight:bold">Nama &nbsp; : &nbsp;</label>
                <input type="text" class="form-control" name="nama" value = "{{ $fnama }}" form="search">
            </div>
            &nbsp;&nbsp;
            <div class="form-group">
                <label for="bahagian" style="font-weight:bold">Bahagian &nbsp; : &nbsp; </label><br />
                <select class="form-control btn-sm " name="bahagian" id="bahagian" form="search">
                    <option value="%">-Semua-</option>

                    @foreach ($bahagians as $bahagian)
                        <option value="{{ $bahagian->id }}" {{ $bahagian->id == $fbahagian ? 'selected' : '' }}>
                            {{ $bahagian->bahagian }}</option>
                    @endforeach

                </select>
            </div>
            &nbsp;&nbsp;
            <div class="form-group">
                <label for="unit" style="font-weight:bold">Unit &nbsp; : &nbsp; </label><br />
                <select class="form-control btn-sm " name="unit" id = "unit" form="search">
                    <option value="%">-Semua-</option>
                    @foreach ($units as $unit)
                        <option value="{{ $unit->id }}" {{ $unit->id == $funit ? 'selected' : '' }}>{{ $unit->unit }}
                        </option>
                    @endforeach
                </select>
            </div>
            &nbsp;&nbsp;
            <br />

            <div class="form-group align-self-end mx-auto" style="text-align: left;">
                <input class="btn btn-primary  mr-3" type="submit" name="" value="Carian" form="search">
            </div><br />
        </form>
    </div>

    <div class="row justify-content-center m-2">
        <div class="table-responsive-lg">

            @can('for-pengguna')
                <div class="alert alert-primary" role="alert">
                    Sila kemas kini pegawai keluar/masuk. Hubungi Unit Pengurusan Maklumat (ICT) sekiranya ada pegawai baru.
                </div>
            @endcan

            <table class="table table-striped table-hover mx-auto" style="width: auto;">
                @can('manage-users')
                    <tr>
                        <td colspan="3">
                        <td>
                        <td>

                            <a href="{{ route('pegawai.create') }}" class="btn btn-primary float-center"></span><i
                                    class="fa-solid fa-address-book"></i> Tambah Pegawai </a>
                        </td>
                    </tr>
                @endcan
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" colspan="2" class="text-center">Maklumat Pegawai</th>
                    <th scope="col" colspan="2" class="text-center">Bahagian / Unit</th>
                </tr>

                @foreach ($pegawais as $key => $pegawai)
                    <tr>
                        <td>{{ $pegawais->firstItem() + $key }}.</td>
                        <td style="text-align: center; width: 125px; height: 125px; vertical-align: middle;">
                            @if ($pegawai->image)
                                <img
                                    src="{{ asset('storage/' . $pegawai->image) }}"
                                    style="
                                        max-width: 125px;
                                        max-height: 125px;
                                        width: auto;
                                        height: auto;
                                        object-fit: contain;
                                        display: block;
                                        margin: auto;
                                    "
                                    alt="{{ $pegawai->nama }}"
                                />
                            @else
                                <img
                                    src="https://st4.depositphotos.com/9998432/22597/v/450/depositphotos_225976914-stock-illustration-person-gray-photo-placeholder-man.jpg"
                                    style="
                                        width: 125px;
                                        height: 125px;
                                        object-fit: contain;
                                        display: block;
                                        margin: auto;
                                    "
                                    alt="Image Placeholder"
                                />
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column" style="padding-top: 5px;">
                                <div class="font-weight-bold mb-1" style="padding-top: 10px;">{{ $pegawai->nama }}</div>
                                <div class="text-muted" style="padding-top: 8x;">
                                    <i class="fa-solid fa-user-tie"></i> {{ $pegawai->jawatan }} {{ $pegawai->gred }}<br>
                                    <i class="fa-solid fa-phone"></i> 04-7741000 Ext : {{ $pegawai->ext }} <br />
                                    @if ($pegawai->email != null && $pegawai->email != '-')
                                        <i class="fa-solid fa-envelope"></i> {{ $pegawai->email }}
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-muted">
                                <br>
                                <i class="fa-solid fa-house"></i> BAHAGIAN : {{ $pegawai->bahagian }} <br />
                                @if ($pegawai->unit != null && $pegawai->unit != '-')
                                    <i class="fa-solid fa-building-circle-arrow-right"></i> UNIT : <br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- <small>{{ $pegawai->unit }}</small>
                                @endif
                            </div>

                        </td>
                        <td style="text-align: center; padding-top: 35px;">
                            @can('edit-users')
                                <a class="btn btn-warning" style="margin-right: 5px;"
                                    href="{{ route('pegawai.edit', $pegawai->id) }}"><i class="fa-solid fa-pencil"></i>
                                    Kemaskini</a>
                            @endcan
                            {{-- @can('delete-users')
                        <form action="{{url('/pegawai/'.$pegawai->id)}}" method="POST" class="d-inline">
                            @csrf
                            {{method_field('DELETE')}}
                            <button onclick="return confirm('Delete {{$pegawai->nama}}')" type="submit" class="btn btn-danger" style="width: 65px;"><i class="fa-solid fa-trash"></i> Delete</button>
                        </form>
                        @endcan --}}
                        </td>
                    </tr>
                @endforeach

            </table>
            <div class="d-flex justify-content-center">
                {{ $pegawais->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection


<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="bahagian"]').on('change', function() {
            var bahagianID = jQuery(this).val();

            if (bahagianID) {
                jQuery.ajax({
                    url: 'http://apps8.kdh.moh.gov.my/edirektori/public/pegawai/getUnit/' +
                        bahagianID,
                    //url : {{ url('/pegawai/getUnit/') }}+bahagianID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('select[name="unit"]').empty();
                        $('select[name="unit"]').append(
                            '<option value="%">-Sila Pilih-</option>')
                        jQuery.each(data, function(key, value) {
                            $('select[name="unit"]').append('<option value="' +
                                key + '">' + value + '</option>')
                        });
                    }
                });
            } else {
                $('select[name="unit"]').empty();
            }

        });
    });
</script>
