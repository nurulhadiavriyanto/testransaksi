<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Models\Barang;
use App\Models\Customer;

class MasterController extends Controller{
    public function barangIndex(){
        $brg = Barang::where('status',1)->orderBy('kode','asc')->get();
        return view('master/barang', ['brg' => $brg]);
    }
    public function barangInput(Request $request){
    	$cbrg = DB::table('m_barang')->where('kode', $request->kdbrg)->count();
        if ($cbrg == 0) {
        	$hrg = preg_replace("/[^0-9]/", "", $request->hrbrg);
            Barang::create([
	            'kode' => $request->kdbrg,
	            'nama' => $request->nmbrg,
	            'harga' => $hrg,
	            'status' => 1
	        ]);
        }
        return Response::json(['success'=>true, 'info'=>$cbrg]);
    }
    public function barangUpdate($id, Request $request){
        $hrg = preg_replace("/[^0-9]/", "", $request->uhrbrg);
        $brg = Barang::find($id);
        $brg->kode = $request->ukdbrg;
        $brg->nama = $request->unmbrg;
        $brg->harga = $hrg;
        $brg->save();
        return redirect('/mbrg');
    }
    public function barangDelete($id){
        $brg = Barang::find($id);
	    $brg->status = 2;
	    $brg->save();
	    return redirect('/mbrg');
    }
    public function customerIndex(){
        $cst = Customer::where('status',1)->orderBy('kode','asc')->get();
        return view('master/customer', ['cst' => $cst]);
    }
    public function customerInput(Request $request){
    	$ccst = DB::table('m_customer')->where('kode', $request->kdcst)->count();
        if ($ccst == 0) {
            Customer::create([
	            'kode' => $request->kdcst,
	            'nama' => $request->nmcst,
	            'telp' => $request->tlcst,
	            'status' => 1
	        ]);
        }
        return Response::json(['success'=>true, 'info'=>$ccst]);
    }
    public function customerUpdate($id, Request $request){
        $cst = Customer::find($id);
        $cst->kode = $request->ukdcst;
        $cst->nama = $request->unmcst;
        $cst->telp = $request->utlcst;
        $cst->save();
        return redirect('/mcst');
    }
    public function customerDelete($id){
        $cst = Customer::find($id);
        $cst->status = 2;
	    $cst->save();
	    return redirect('/mcst');
    }
}