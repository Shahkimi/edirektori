@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-auto">

        <h1>gred</h1>   

        <a href="{{ route('kawalan.create_gred') }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Add </a><br/> <br/>
        <table class="table table-striped table-responsive">
            <tr>
                <th scope="col">#</th>
                <th scope="col">gred</th>
                <th scope="col">Tindakan</th>
            </tr>

            <tr>
                <form action="{{url('/kawalan/gred/search')}}" method="Get" id="search">
                @csrf
                <th scope="col"></th>
                <th scope="col"><input class="form-control" type="text" name="gred" form="search"></th>
                <th scope="col"><input class="btn btn-primary" type="submit" name="" value="Carian" form="search"></th>
                </caption>
                </form>
            </tr>

            <?php $i=0;?>
            @foreach($greds as $key=>$gred)
                <?php $i++; ?>
                <tr>
                    <td>{{$greds->firstItem() + $key}}.</td>
                    <td>{{$gred->gred}}</td>
                    <td>
                        <a href="{{ route('kawalan.edit_gred',$gred->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-zoom-in"></span> Edit</a>
                        <a href="{{ route('kawalan.show_gred',$gred->id) }}" class="btn-info btn-sm"><span class="glyphicon glyphicon-remove"></span> Remove</a>
                    </td>                
                </tr>
            @endforeach
        
        </table>

        {{ $greds->links() }}

</div>
</div>




@endsection

