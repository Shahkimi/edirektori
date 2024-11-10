<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Unit;
use DB;

use Illuminate\Support\Facades\Auth;


class PegawaiController extends Controller
{

    public function index() {

        $id = Auth::id();

        $roles = DB::table('role_user')
            ->select('role_user.*', 'bahagian_user.bahagian_id')
            ->leftjoin('bahagian_user', 'bahagian_user.user_id', '=', 'role_user.user_id')
            ->where('role_user.user_id',$id)
            ->get();

        $role = 1;

        foreach ($roles as $a) {
           $role = $a->role_id;
           $id = $a->user_id;
           $bahagian1 = $a->bahagian_id;
        }

        if($role == 1){  //admin
            $filter_bahagian = '%';
        } else {
            $filter_bahagian = $bahagian1;
        }

        $pegawais = Pegawai::all();

        $bahagians = DB::table('tbahagian')
                        ->orderBy('bahagian', 'desc')
                        ->where('id', 'like', $filter_bahagian)
                        ->get();

        $jawatans = DB::table('tjawatan')->orderBy('jawatan', 'asc')->get();
        $units = DB::table('tunit')->orderBy('unit', 'asc')->get();

        $pegawais = DB::table('pegawai')
            ->select('pegawai.*', 'tbahagian.bahagian','tunit.unit','tjawatan.jawatan','tgred.gred','tgred.gred2')
            ->leftJoin('tbahagian', 'tbahagian.id', '=', 'pegawai.idbahagian')
            ->leftJoin('tunit', 'tunit.id', '=', 'pegawai.idunit')
            ->leftJoin('tjawatan', 'tjawatan.id', '=', 'pegawai.idjawatan')
            ->leftJoin('tgred', 'tgred.id', '=', 'pegawai.idgred')
            ->where('pegawai.idbahagian','like', $filter_bahagian)
            ->orderBy('bahagian', 'asc')
            ->orderBy('unit', 'asc')
            ->orderBy('gred2', 'desc')
            ->orderBy('nama', 'asc')
            ->paginate(10);

    // echo json_encode($pegawais);

	    return view('pegawai.index',
	    	['pegawais' => $pegawais,
             'jawatans' => $jawatans,
             'bahagians' => $bahagians,
             'units' => $units,
		])
        ->with('fnama',)
        ->with('fext',)
        ->with('femail',)
        ->with('fjawatan',)
        ->with('fbahagian',)
        ->with('funit',)
        ;

    }

    public function show($id) {

        $pegawai = DB::table('pegawai')
            ->select('pegawai.*', 'tbahagian.bahagian','tunit.unit','tjawatan.jawatan','tgred.gred')
            ->leftJoin('tbahagian', 'tbahagian.id', '=', 'pegawai.idbahagian')
            ->leftJoin('tunit', 'tunit.id', '=', 'pegawai.idunit')
            ->leftJoin('tjawatan', 'tjawatan.id', '=', 'pegawai.idjawatan')
            ->leftJoin('tgred', 'tgred.id', '=', 'pegawai.idgred')
            ->where('pegawai.id','=', $id)
            ->get();

    // echo json_encode($pegawai);

    	return view('pegawai.show', ['pegawai' => $pegawai,
                                    ])->with('ftajuk','View');
    }

    public function create() {

        $jawatans = DB::table('tjawatan')->orderBy('jawatan', 'asc')->get();
        $greds = DB::table('tgred')->orderBy('gred', 'asc')->get();
        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'desc')->get();
        $units = DB::table('tunit')->orderBy('unit', 'asc')->get();

        return view('pegawai.create',
                    [
                        'jawatans' => $jawatans,
                        'greds' => $greds,
                        'bahagians' => $bahagians,
                        'units' => $units,
                    ]);

    }

    public function store() {

        $pegawai = new Pegawai();

        $pegawai->nama = request('nama');
        $pegawai->ext = request('ext');
        $pegawai->email = request('email');
        $pegawai->idjawatan = request('idjawatan');
        $pegawai->idgred = request('idgred');
        $pegawai->idbahagian = request('idbahagian');
        $pegawai->idunit = request('idunit');

        $pegawai->save();

        return redirect('/pegawai')->with('mssg','Rekod telah dikemaskini');
    }

    public function destroy($id) {
        $pegawai = Pegawai::FindOrFail($id);
        $pegawai->delete();

        return redirect('/pegawai');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $fnama = request('nama');
        $fidbahagian = request('idbahagian');
        $fidunit = request('idunit');

        $jawatans = DB::table('tjawatan')->orderBy('jawatan', 'asc')->get();
        $greds = DB::table('tgred')->orderBy('gred', 'asc')->get();
        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'desc')->get();
        $units = DB::table('tunit')->orderBy('unit', 'asc')->get();

        return view('pegawai.edit',
                    [
                        'pegawai' => $pegawai,
                        'jawatans' => $jawatans,
                        'greds' => $greds,
                        'bahagians' => $bahagians,
                        'units' => $units,
                    ]);

    }

     public function update()
    {
        $pegawai = new pegawai();

        $id = request('id');
        $nama = request('nama');
        $ext = request('ext');
        $email = request('email');
        $idjawatan = request('idjawatan');
        $idgred = request('idgred');
        $idbahagian = request('idbahagian');
        $idunit = request('idunit');

        Pegawai::where('id', $id)->update(array(
            'nama'    => $nama,
            'ext' =>  $ext,
            'email'  => $email,
            'idjawatan'  => $idjawatan,
            'idgred'  => $idgred,
            'idbahagian'  => $idbahagian,
            'idunit'  => $idunit,
        ));

        return redirect('/pegawai/')->with('success','Maklumat berjaya dikemaskini.');
    }

    public function search() {

        $bahagian = request('bahagian');
        $unit = request('unit');

        $id = Auth::id();

        $role = 1;

        $roles = DB::table('role_user')
            ->select('role_user.*', 'bahagian_user.bahagian_id')
            ->leftjoin('bahagian_user', 'bahagian_user.user_id', '=', 'role_user.user_id')
            ->where('role_user.user_id',$id)
            ->get();

        foreach ($roles as $a) {
           $role = $a->role_id;
           $id = $a->user_id;
           $bahagian1 = $a->bahagian_id;
        }

        if($role == 1){  //admin
            $filter_bahagian = $bahagian;
        } else {
            $filter_bahagian = $bahagian1;
        }


        $jawatans = DB::table('tjawatan')->orderBy('jawatan', 'asc')->get();
        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->where('id', 'like', $filter_bahagian)->get();
        $units = DB::table('tunit')->orderBy('unit', 'asc')->where('idbahagian', 'like', $filter_bahagian)->get();



       if ($nama==NULL)  $nama="";

        $pegawais = DB::table('pegawai')
            ->select('pegawai.*', 'tbahagian.bahagian','tunit.unit','tjawatan.jawatan','tgred.gred', 'tgred.gred2')
            ->leftJoin('tbahagian', 'tbahagian.id', '=', 'pegawai.idbahagian')
            ->leftJoin('tunit', 'tunit.id', '=', 'pegawai.idunit')
            ->leftJoin('tjawatan', 'tjawatan.id', '=', 'pegawai.idjawatan')
            ->leftJoin('tgred', 'tgred.id', '=', 'pegawai.idgred')
            ->where('nama','like', '%'.$nama.'%')
            ->where('pegawai.idunit','like', $unit)
            ->where('pegawai.idbahagian', 'like', $filter_bahagian)
            ->orderBy('bahagian', 'asc')
            ->orderBy('unit', 'asc')
            ->orderBy('gred2', 'desc')
            ->orderBy('nama', 'asc')
            ->paginate(10);

        //echo json_encode($pegawais);
       // echo $jawatan;


        return view('pegawai.index',
            ['pegawais' => $pegawais,
             'jawatans' => $jawatans,
             'bahagians' => $bahagians,
             'units' => $units,
        ])
        ->with('fnama', $nama)
        ->with('fbahagian', $bahagian)
        ->with('funit', $unit)
        ;

    }


    public function getUnit($id)
    {
        $unit = Unit::where('idbahagian',$id)->pluck("unit","id");
        return json_encode($unit);
    }


    public function get_by_bahagian(Request $request)
    {

    //abort_unless(\Gate::allows('city_access'), 401);

        if (!$request->idbahagian) {
            $html = '<option value="">'.'Sila Pilih'.'</option>';
        } else {
            $html = '';
            $units = Unit::where('idbahagian', $request->idbahagian)->orderBy('unit', 'asc')->get();
            foreach ($units as $unit) {
                $html .= '<option value="'.$unit->id.'">'.$unit->unit.'</option>';
            }
        }

        return response()->json(['html' => $html]);
    }

    public function carian()
    {

        $id = Auth::id();
        $role = 1;

        $roles = DB::table('role_user')
            ->select('role_user.*', 'bahagian_user.bahagian_id')
            ->leftjoin('bahagian_user', 'bahagian_user.user_id', '=', 'role_user.user_id')
            ->where('role_user.user_id',$id)
            ->get();

        foreach ($roles as $a) {
           $role = $a->role_id;
           $id = $a->user_id;
           $bahagian1 = $a->bahagian_id;
        }

        if($role == 1){  //admin
            $filter_bahagian = '%';
        } else {
            $filter_bahagian = $bahagian1;
        }

        $bahagians = DB::table('tbahagian')->orderBy('bahagian', 'asc')->where('id', 'like', $filter_bahagian)->get();
        $units = DB::table('tunit')->orderBy('unit', 'asc')->where('idbahagian', 'like', $filter_bahagian)->get();

        return view('pegawai.carian',
            ['bahagians' => $bahagians,
            'units' => $units,
        ]);

    }


}
