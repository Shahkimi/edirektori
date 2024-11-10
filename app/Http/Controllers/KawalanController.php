<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawatan;
use App\Gred;
use App\Bahagian;
use App\Unit;
use DB;

class KawalanController extends Controller
{

    public function index_jawatan() {

        $jawatans = DB::table('tjawatan')->orderBy('jawatan', 'asc')->paginate(20);

	    return view('kawalan.jawatan.index', 
	    	['jawatans' => $jawatans,
		      ]);
    }

    public function show_jawatan($id) {

        $jawatan = Jawatan::findOrFail($id);

        return view('kawalan.jawatan.show', ['jawatan' => $jawatan]);
    }

    public function create_jawatan() {
    	return view('kawalan.jawatan.create');
    }

    public function store_jawatan() { 

        $jawatan = new Jawatan();
        $jawatan->jawatan = request('jawatan');
        $jawatan->save();

        return redirect('/kawalan/jawatan')->with('mssg','Thanks for your order');
    }

    public function destroy_jawatan($id) {
        $jawatan = Jawatan::FindOrFail($id);
        $jawatan->delete();

        return redirect('/kawalan/jawatan')->with('mssg','Jawatan Telah Dikemaskini'); 
    }

    public function edit_jawatan($id)
    {
        $jawatan = Jawatan::findOrFail($id);
        return view('kawalan.jawatan.edit', ['jawatan' => $jawatan]);
    }

     public function update_jawatan()
    {
        $jawatan = new jawatan();

        $id = request('id');
        $jawatan = request('jawatan');

        Jawatan::where('id', $id)->update(array(
            'jawatan'    => $jawatan
        ));                

        return redirect('/kawalan/jawatan')->with('success','Maklumat berjaya dikemaskini.');
    }


    public function search_jawatan(){

        $jawatan = request('jawatan');

        $jawatans = DB::table('tjawatan')
                    ->where('jawatan','like', '%'.$jawatan.'%')
                    ->paginate(25);

        return view('kawalan.jawatan.index', 
            ['jawatans' => $jawatans,
              ]);

    }

/*-------------------------GRED--------------------------------------------*/

    public function index_gred() {

        $greds = DB::table('tgred')->orderBy('gred', 'asc')->paginate(20);

        return view('kawalan.gred.index', 
            ['greds' => $greds,
              ]);
    }

    public function show_gred($id) {

        $gred = Gred::findOrFail($id);

        return view('kawalan.gred.show', ['gred' => $gred]);
    }

    public function create_gred() {
        return view('kawalan.gred.create');
    }

    public function store_gred() { 

        $gred = new gred();
        $gred->gred = request('gred');
        $gred->save();

        return redirect('/kawalan/gred')->with('mssg','Thanks for your order');
    }

    public function destroy_gred($id) {
        $gred = Gred::FindOrFail($id);
        $gred->delete();

        return redirect('/kawalan/gred')->with('mssg','gred Telah Dikemaskini'); 
    }

    public function edit_gred($id)
    {
        $gred = Gred::findOrFail($id);
        return view('kawalan.gred.edit', ['gred' => $gred]);
    }

     public function update_gred()
    {
        $gred = new gred();

        $id = request('id');
        $gred = request('gred');

        Gred::where('id', $id)->update(array(
            'gred'    => $gred
        ));                

        return redirect('/kawalan/gred')->with('success','Maklumat berjaya dikemaskini.');
    }    

    public function search_gred(){

        $gred = request('gred');

        $greds = DB::table('tgred')
                    ->where('gred','like', '%'.$gred.'%')
                    ->paginate(25);

        return view('kawalan.gred.index', 
            ['greds' => $greds,
              ]);
        
    }

/*-------------------------BAHAGIAN--------------------------------------------*/

    public function index_bahagian() {

        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->paginate(20);

        return view('kawalan.bahagian.index', 
            ['bahagians' => $bahagians,
              ]);
    }

    public function show_bahagian($id) {

        $bahagian = Bahagian::findOrFail($id);

        return view('kawalan.bahagian.show', ['bahagian' => $bahagian]);
    }

    public function create_bahagian() {
        return view('kawalan.bahagian.create');
    }

    public function store_bahagian() { 

        $bahagian = new bahagian();
        $bahagian->bahagian = request('bahagian');
        $bahagian->save();

        return redirect('/kawalan/bahagian')->with('mssg','Thanks for your order');
    }

    public function destroy_bahagian($id) {
        $bahagian = Bahagian::FindOrFail($id);
        $bahagian->delete();

        return redirect('/kawalan/bahagian')->with('mssg','bahagian Telah Dikemaskini'); 
    }

    public function edit_bahagian($id)
    {
        $bahagian = Bahagian::findOrFail($id);
        return view('kawalan.bahagian.edit', ['bahagian' => $bahagian]);
    }

     public function update_bahagian()
    {
        $bahagian = new bahagian();

        $id = request('id');
        $bahagian = request('bahagian');

        Bahagian::where('id', $id)->update(array(
            'bahagian'    => $bahagian
        ));                

        return redirect('/kawalan/bahagian')->with('success','Maklumat berjaya dikemaskini.');
    } 

    public function search_bahagian(){

        $bahagian = request('bahagian');

        $bahagians = DB::table('tbahagian')
                    ->where('bahagian','like', '%'.$bahagian.'%')
                    ->paginate(25);

        return view('kawalan.bahagian.index', 
            ['bahagians' => $bahagians,
              ]);
        
    }

/*-------------------------UNIT--------------------------------------------*/

    public function index_unit() {

        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->get();

        $units = DB::table('tunit')
            ->select('tunit.*', 'tbahagian.bahagian')
            ->join('tbahagian', 'tbahagian.id', '=', 'tunit.idbahagian')
            ->orderBy('bahagian', 'asc')
            ->orderBy('unit', 'asc')
            ->paginate(25);

        //echo json_encode($bahagians);

        return view('kawalan.unit.index',
            ['units' => $units,
             'bahagians' => $bahagians,
              ])
         ->with('fbahagian',)
         ->with('funit',); ;

    }

    public function show_unit($id) {

         $unit = DB::table('tunit')
                    ->select('tunit.id', 'tunit.unit', 'tbahagian.bahagian')
                    ->join('tbahagian', 'tbahagian.id', '=', 'tunit.idbahagian')
                    ->where('tunit.id', 'like', $id)
                    ->get();

        $unit = Unit::FindOrFail($id);

        //echo json_encode($unit);

        return view('kawalan.unit.show', ['unit' => $unit]);
    }

    public function create_unit() {
        
        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->get();

        return view('kawalan.unit.create')->with('bahagians',$bahagians);
    }

    public function store_unit() { 

        $unit = new unit();
        $unit->unit = request('unit');
        $unit->idbahagian = request('idbahagian');
        $unit->save();

        return redirect('/kawalan/unit')->with('mssg','Thanks for your order');
    }

    public function destroy_unit($id) {
        $unit = Unit::FindOrFail($id);
        $unit->delete();

        return redirect('/kawalan/unit')->with('mssg','unit Telah Dikemaskini'); 
    }

    public function edit_unit($id)
    {
        $unit = Unit::findOrFail($id);

        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->get();

        return view('kawalan.unit.edit', ['unit' => $unit, 'bahagians' => $bahagians]);
    }

     public function update_unit()
    {
        $unit = new unit();

        $id = request('id');
        $unit = request('unit');
        $idbahagian = request('idbahagian');

        Unit::where('id', $id)->update(array(
            'unit'    => $unit,
            'idbahagian'    => $idbahagian
        ));                

        return redirect('/kawalan/unit')->with('success','Maklumat berjaya dikemaskini.');
    }   

    public function search_unit(){

        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->get();
        
        $idbahagian = request('bahagian');
        $unit = request('unit');

        if ($unit==NULL) {  
            $unit="";
        }

        //echo json_encode($unit);

        $units = DB::table('tunit')
            ->select('tunit.*', 'tbahagian.bahagian')
            ->join('tbahagian', 'tbahagian.id', '=', 'tunit.idbahagian')
            ->where('unit','like', '%'.$unit.'%')
            ->where('idbahagian','like', '%'.$idbahagian.'%')
            ->orderBy('bahagian', 'asc')
            ->orderBy('unit', 'asc')
            ->paginate(25);


        return view('kawalan.unit.index', 
            ['units' => $units,
             'bahagians' => $bahagians,
              ])
        ->with('fbahagian',$idbahagian)
        ->with('funit',$unit); 

    }
}
