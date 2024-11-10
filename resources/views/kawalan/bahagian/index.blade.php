@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-auto">

        <h1>bahagian</h1>   

        <a href="{{ route('kawalan.create_bahagian') }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Add </a><br/> <br/>
        <table class="table table-striped table-responsive">
            <tr>
                <th scope="col">#</th>
                <th scope="col">bahagian</th>
                <th scope="col">Tindakan</th>
            </tr>

            <tr>
                <form action="{{url('/kawalan/bahagian/search')}}" method="Get" id="search">
                @csrf
                <th scope="col"></th>
                <th scope="col"><input class="form-control" type="text" name="bahagian" form="search"></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
                </caption>
                </form>
            </tr>
            
            <?php $i=0;?>
            @foreach($bahagians as $key=>$bahagian)
                <?php $i++; ?>
                <tr>
                    <td>{{$bahagians->firstItem() + $key}}.</td>
                    <td>{{$bahagian->bahagian}}</td>
                    <td>
                        <a href="{{ route('kawalan.edit_bahagian',$bahagian->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Edit</a>
                        <a href="{{ route('kawalan.show_bahagian',$bahagian->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                    </td>                
                </tr>
            @endforeach

        </table>

        {{ $bahagians->links() }}

</div>
</div>




@endsection

