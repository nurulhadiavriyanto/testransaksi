<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\Models\Penjualan;
use App\Models\Customer;
use App\Models\Barang;
use App\Models\DetailPenjualan;

class TransaksiController extends Controller{
    public function penjualanIndex(){
    	$ctpnj = Penjualan::count();
        $jml = $ctpnj+1;
        $rbrg = DetailPenjualan::where('status', 1)->delete();
        return view('transaksi/f_penjualan', ['ctpnj' => $jml]);
    }
    public function customerLoad(Request $request){
        $query = $request->get('pnjkdcst');
        $cst = Customer::where('kode', 'LIKE', '%'. $query.'%')->where('status',1)->get();
        $res = array();
        foreach ($cst as $c) {
            $res[] = $c->kode;
        }
        return response()->json($res);
    }
    public function customerId($id){
        $cst = Customer::where('kode', $id)->get();
        foreach ($cst as $c) {
        	return Response::json(['success'=>true, 'nmcst'=>$c->nama, 'tlcst'=>$c->telp, 'idcst'=>$c->id]);
        }
    }
    public function barangLoad(Request $request){
        $query = $request->get('pnjbrg');
        $brg = Barang::where('kode', 'LIKE', '%'. $query.'%')->where('status',1)->get();
        $res = array();
        foreach ($brg as $b) {
            $res[] = $b->kode.' - '.$b->nama;
        }
        return response()->json($res);
    }
    public function barangInput($id){
        $code = strtok($id, ' ');
        $brg = Barang::where('kode', $code)->get();
        foreach ($brg as $b) {
            $cdtpnj = DetailPenjualan::where('barang_id',$b->id)->where('status',1)->count();
            if ($cdtpnj==0) {
                DetailPenjualan::create([
                	'sales_id' => 0,
                    'barang_id' => $b->id,
                    'harga_bandrol' => $b->harga,
                    'qty' => 0,
                    'diskon_pct' => 0,
                    'diskon_nilai' => 0,
                    'harga_diskon' => $b->harga,
                    'total' => 0,
                    'status' => 1
                ]);
            }
        }
    }
    public function detailpenjualanIndex(){
    	$dtpnj = DB::table('t_sales_det as a')->select('b.kode','b.nama','a.harga_bandrol','a.id','a.qty','a.diskon_pct','a.diskon_nilai','a.harga_diskon','a.total')->join('m_barang as b', 'a.barang_id', '=', 'b.id')->where('a.status',1)->orderBy('a.created_at','desc')->get();
    	return response()->json($dtpnj);
    }
    public function qtypenjualanInput(Request $request){
        $pnj = DetailPenjualan::find($request->id);
        $pnj->qty = $request->qty;
        $pnj->total = $request->ttl;
        $pnj->save();
    }
    public function dispenjualanInput(Request $request){
        $pnj = DetailPenjualan::find($request->id);
        $pnj->diskon_pct = $request->dp;
        $pnj->diskon_nilai = $request->dn;
        $pnj->harga_diskon = $request->hd;
        $pnj->total = $request->ttl;
        $pnj->save();
    }
    public function detpenjualanDelete($id){
        $pnj = DetailPenjualan::find($id);
        $pnj->delete();
    }
    public function penjualanInput(Request $request){
    	$sub = preg_replace("/[^0-9]/", "", $request->sub);
    	if ($request->dis=='') {
    		$dis=0;
    	}else{
    		$dis = preg_replace("/[^0-9]/", "", $request->dis);
    	}
    	if ($request->okr=='') {
    		$okr=0;
    	}else{
    		$okr = preg_replace("/[^0-9]/", "", $request->okr);
    	}
    	$ttl = preg_replace("/[^0-9]/", "", $request->ttl);
    	$time = date('H-i-s');
        Penjualan::create([
            'kode' => $request->kd,
            'tgl' => date('Y-m-d', strtotime($request->tgl)).' '.$time,
            'cust_id' => $request->idcst,
            'subtotal' => $sub,
            'diskon' => $dis,
            'ongkir' => $okr,
            'total_bayar' => $ttl
        ]);
        $pnj = Penjualan::orderBy('id','DESC')->take(1)->get();
        foreach ($pnj as $p) {
        	$idp = $p->id;
        }
        DB::table('t_sales_det')->where('status','=',1)->update([
            'sales_id'=>$idp,
            'status' => 2
        ]);
    }
    public function penjualanList(){
        $pnj = DB::table('t_sales as a')->select('a.kode','a.tgl','b.nama','a.subtotal','a.diskon','a.ongkir','a.total_bayar','a.id')->join('m_customer as b', 'a.cust_id', '=', 'b.id')->orderBy('a.created_at','asc')->get();
        return view('transaksi/d_penjualan', ['pnj' => $pnj]);
    }
}