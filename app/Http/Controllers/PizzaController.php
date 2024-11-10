<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pizza;

class PizzaController extends Controller
{
    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function index() {

    	$pizzas = Pizza::all();
    	//$pizzas = Pizza::orderBy('name','desc')->get();
    	// $pizzas = Pizza::where('type','hawaiian')->get();
    	// $pizzas = Pizza::latest()->get();

	    return view('pizzas.index', 
	    	['pizzas' => $pizzas,
		]);
    }

    public function show($id) {

    	$pizza = Pizza::findOrFail($id);

    	return view('pizzas.show', ['pizza' => $pizza]);
    }

    public function create() {
    	return view('pizzas.create');
    }

    public function store() { 

        $pizza = new Pizza();

        $pizza->name = request('name');
        $pizza->type = request('type');
        $pizza->base = request('base');
        $pizza->toppings = request('toppings');

        $pizza->save();

        return redirect('/')->with('mssg','Thanks for your order');
    }

    public function destroy($id) {
        $pizza = Pizza::FindOrFail($id);
        $pizza->delete();

        return redirect('/pizzas'); 
    }

    public function edit($id)
    {
        $pizza = Pizza::findOrFail($id);

        return view('pizzas.edit', ['pizza' => $pizza]);
    }


     public function update()
    {
        $pizza = new Pizza();

        $id = request('id');
        $name = request('name');
        $type = request('type');
        $base = request('base');
        $toppings = request('toppings');

        Pizza::where('id', $id)->update(array(
            'name'    => $name,
            'type' =>  $type,
            'base'  => $base,
            'toppings'  => $toppings
        ));                

        return redirect('/pizzas/')->with('success','Maklumat berjaya dikemaskini.');
    }

}
