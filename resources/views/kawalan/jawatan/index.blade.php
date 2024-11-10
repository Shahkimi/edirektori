@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-auto">

        <h1>Jawatan</h1>   

        <a href="{{ route('kawalan.create_jawatan') }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Add </a><br/> <br/>

        <table class="table table-striped table-responsive">

            <tr>
                <th scope="col">#</th>
                <th scope="col">Jawatan</th>
                <th scope="col">Tindakan</th>
            </tr>

            <tr>
                <form action="{{url('/kawalan/jawatan/search')}}" method="Get" id="search">
                @csrf
                <th scope="col"></th>
                <th scope="col"><input class="form-control" type="text" name="jawatan" form="search"></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
                </caption>
                </form>
            </tr>

            <?php $i=0;?>
            @foreach($jawatans as $key=>$jawatan)
                <?php $i++; ?>
                <tr>
                    <td>{{$jawatans->firstItem() + $key}}.</td>
                    <td>{{$jawatan->jawatan}}</td>
                    <td>
                        <a href="{{ route('kawalan.edit_jawatan',$jawatan->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Edit</a>
                        <a href="{{ route('kawalan.show_jawatan',$jawatan->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                    </td>                
                </tr>
            @endforeach
        </table>

        {{ $jawatans->links() }}
</div>
</div>




@endsection

