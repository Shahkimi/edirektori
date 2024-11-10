<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@extends('layouts.app')

@section('content')
    <br />

    <div class="container-fluid">

        <form class="bg-light rounded p-4 shadow-lg" action="{{ url('/pegawai/') }}" method="POST"
            style="max-width: 500px; margin: auto;" enctype="multipart/form-data">
            @csrf

            <h1 style="text-align:center;">Tambah Direktori Pegawai</h1>
            <br />

            <label for="nama"> Nama : <font color="red">*</font></label><br />
            <input type = "text" id = "nama" name="nama" class="form-control" required>
            <br />

            <label for="ext"> Ext : <font color="red">*</font></label><br />
            <input type = "text" id = "ext" name="ext" class="form-control" required>
            <br />

            <label for="email"> Emel : <font color="red">*</font></label><br />
            <input type = "text" id = "email" name="email" class="form-control">
            <br />


            <label for="idjawatan"> Jawatan: <font color="red">*</font></label><br />
            <select class="form-control btn-sm " name="idjawatan" id = "idjawatan" required>

                <option value="%">-Semua-</option>

                @foreach ($jawatans as $jawatan)
                    <option value="{{ $jawatan->id }}">{{ $jawatan->jawatan }}</option>
                @endforeach

            </select></th><br />


            <label for="idgred"> Gred: <font color="red">*</font></label><br />
            <select class="form-control btn-sm " name="idgred" id = "idgred" required>

                <option value="%">-Semua-</option>

                @foreach ($greds as $gred)
                    <option value="{{ $gred->id }}">{{ $gred->gred }}</option>
                @endforeach

            </select></th><br />

            <label for="idbahagian"> Bahagian: <font color="red">*</font></label><br />
            <select class="form-control btn-sm " name="idbahagian" id = "idbahagian" required>

                <option value="%">-Sila Pilih-</option>

                @foreach ($bahagians as $bahagian)
                    <option value="{{ $bahagian->id }}">{{ $bahagian->bahagian }}</option>
                @endforeach

            </select></th><br />

            <label for="idunit"> Unit: <font color="red">*</font></label><br />
            <select class="form-control btn-sm " name="idunit" id = "idunit" required>

                <option value="%">-Sila Pilih-</option>

            </select></th><br />

            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Profile</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="formFile" name="image"
                            aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label" for="formFile">Pilih fail</label>
                    </div>
                </div>
            </div>

            <div style="text-align: center;">
                <a class="btn btn-outline-danger btn-sm mb-2" href="javascript:history.back()">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary btn-sm mb-2">
            </div>

        </form>
    </div>
@endsection

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="idbahagian"]').on('change', function() {
            var bahagianID = jQuery(this).val();

            if (bahagianID) {
                jQuery.ajax({
                    url: `/pegawai/getUnit/${bahagianID}`,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('select[name="idunit"]').empty();
                        // Add default option
                        jQuery('select[name="idunit"]').append(
                            '<option value="%">-Sila Pilih-</option>');
                        // Add units from response
                        jQuery.each(data, function(key, value) {
                            jQuery('select[name="idunit"]').append(
                                '<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching units:', error);
                    }
                });
            } else {
                jQuery('select[name="idunit"]').empty();
                jQuery('select[name="idunit"]').append('<option value="%">-Sila Pilih-</option>');
            }
        });
    });
</script>
