@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-auto">

        <h1>unit</h1>   

        <a href="{{ route('kawalan.create_unit') }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Add </a><br/> <br/>
        <table class="table table-striped table-responsive">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Bahagian</th>
                <th scope="col">Unit</th>
                <th scope="col">Tindakan</th>
            </tr>

            <tr>
                <form action="{{url('/kawalan/unit/search')}}" method="Get" id="search">
                @csrf
                <th scope="col"></th>

                <th scope="col">

                <select class="form-control btn-sm " name="bahagian" form="search">
                    <option value="%">-Semua-</option>

                    @foreach($bahagians as $bahagian)
                        <option value="{{ $bahagian->id }}" {{ ($bahagian->id == $fbahagian)? "selected" : "" }} >{{ $bahagian->bahagian }}</option>
                    @endforeach

                </select></th>

                <th scope="col"><input class="form-control" type="text" name="unit" value = "{{ $funit }}" form="search"></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
                </form>
            </tr>

            <?php $i=0;?>
            @foreach($units as $key=>$unit)
            
                <?php $i++; ?>
                <tr>
                    <td>{{$units->firstItem() + $key}}.</td>
                    <td>{{$unit->bahagian}}</td>
                    <td>{{$unit->unit}}</td>
                    <td>
                        <a href="{{ route('kawalan.edit_unit',$unit->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Edit</a>
                        <a href="{{ route('kawalan.show_unit',$unit->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                    </td>                
                </tr>
            @endforeach

        </table>
        
        {{ $units->links() }}

</div>
</div>




@endsection

