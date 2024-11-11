@extends('layouts.app')

@section('content')
    <br />

    <div class="container-fluid">

        <form class="bg-light rounded p-4 shadow-lg" action="{{ url('/pegawai/edit') }}" method="POST"
            style="max-width: 500px; margin: auto;" enctype="multipart/form-data">
            @csrf

            <h1 style="text-align:center;">Kemaskini Direktori Pegawai</h1>
            <br />

            <input type="text" name="id" id="id" class="form-control" value="{{ $pegawai->id }}" hidden>

            <div>
                <label for="nama"> Nama : </label><br />
                <input type = "text" id = "nama" name="nama" class="form-control" value="{{ $pegawai->nama }}">
                <br />
            </div>

            <div>
                <label for="ext"> Ext : </label><br />
                <input type = "text" id = "ext" name="ext" class="form-control" value="{{ $pegawai->ext }}">
                <br />
            </div>

            <div>
                <label for="email"> Emel : </label><br />
                <input type = "text" id = "email" name="email" class="form-control" value="{{ $pegawai->email }}"
                    placeholder="Contoh: user@moh.gov.my">
                <br />
            </div>

            <div>
                <label for="idjawatan"> Jawatan: </label><br />
                <select class="form-control btn-sm " name="idjawatan" id = "idjawatan">

                    <option value="%">-Semua-</option>

                    @foreach ($jawatans as $jawatan)
                        <option value="{{ $jawatan->id }}" {{ $jawatan->id == $pegawai->idjawatan ? 'selected' : '' }}>
                            {{ $jawatan->jawatan }}</option>
                    @endforeach

                </select></th><br />
            </div>

            <div>
                <label for="idgred"> Gred: </label><br />
                <select class="form-control btn-sm " name="idgred" id = "idgred">

                    <option value="%">-Semua-</option>

                    @foreach ($greds as $gred)
                        <option value="{{ $gred->id }}" {{ $gred->id == $pegawai->idgred ? 'selected' : '' }}>
                            {{ $gred->gred }}</option>
                    @endforeach

                </select></th><br />
            </div>

            <label for="idbahagian"> Bahagian: </label><br />
            <select class="form-control btn-sm " name="idbahagian" id = "idbahagian">

                <option value="%">-Semua-</option>

                @foreach ($bahagians as $bahagian)
                    <option value="{{ $bahagian->id }}" {{ $bahagian->id == $pegawai->idbahagian ? 'selected' : '' }}>
                        {{ $bahagian->bahagian }}</option>
                @endforeach

            </select></th><br />

            <label for="idunit"> Unit: </label><br />
            <select class="form-control btn-sm " name="idunit" id = "idunit">

                <option value="%">-Semua-</option>

                @foreach ($units as $unit)
                    <option value="{{ $unit->id }}" {{ $unit->id == $pegawai->idunit ? 'selected' : '' }}>
                        {{ $unit->unit }}</option>
                @endforeach

            </select></th><br /><br />

            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar Profile</label>
                @if ($pegawai->image)
                    <div class="mb-2 text-center">

                        @php
                            $imagePath = $pegawai->image;
                            // Remove 'public/' if it's in the path
                            $imagePath = str_replace('public/', '', $imagePath);
                        @endphp

                        <img src="{{ asset('storage/'.$imagePath) }}"
                            alt="Current Profile Picture"
                            class="img-thumbnail"
                            style="max-width: 150px; display: inline-block;">

                    </div>
                @else
                    <div class="mb-2 text-center">
                        <p>No image uploaded</p>
                    </div>
                @endif

                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="formFile" name="image"
                            aria-describedby="inputGroupFileAddon01" accept="image/*">
                        <label class="custom-file-label" for="formFile" id="fileLabel">
                            {{ $pegawai->image ? basename($pegawai->image) : 'Choose Image' }}
                        </label>
                    </div>
                </div>
                <small class="form-text text-muted">Leave empty to keep current image</small>
            </div>

            <div style="text-align: center;">
                <a class="btn btn-outline-danger mb-2" href="javascript:history.back()">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary mb-2">
            </div>

        </form>
    </div>
@endsection

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('select[name="idbahagian"]').on('change', function() {
            var bahagianID = jQuery(this).val();

            //alert(bahagianID);

            if (bahagianID) {
                jQuery.ajax({
                    url: 'http://apps8.kdh.moh.gov.my/edirektori/public/pegawai/getUnit/' +
                        bahagianID,
                    //url : {{ url('/pegawai/getUnit/') }}+bahagianID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        jQuery('select[name="idunit"]').empty();
                        jQuery.each(data, function(key, value) {
                            $('select[name="idunit"]').append('<option value="' +
                                key + '">' + value + '</option>')
                        });
                    }
                });
            } else {
                $('select[name="idunit"]').empty();
            }
        });
    });

    // Javascript for show file name
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('formFile');
        const fileLabel = document.getElementById('fileLabel');

        function truncateFilename(filename, maxLength = 25) {
            if (filename.length <= maxLength) return filename;
            const extension = filename.split('.').pop();
            const nameWithoutExt = filename.substring(0, filename.lastIndexOf('.'));
            const truncatedName = nameWithoutExt.substring(0, maxLength - extension.length - 3) + '...';
            return `${truncatedName}.${extension}`;
        }

        fileInput.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const filename = this.files[0].name;
                fileLabel.textContent = truncateFilename(filename);
                fileLabel.title = filename; // Show full filename on hover
            } else {
                const currentImage =
                    '{{ $pegawai->image ? basename($pegawai->image) : 'Choose Image' }}';
                fileLabel.textContent = truncateFilename(currentImage);
                fileLabel.title = currentImage;
            }
        });
    });
</script>
