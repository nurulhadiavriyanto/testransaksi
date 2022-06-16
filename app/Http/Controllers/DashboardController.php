<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;

class DashboardController extends Controller{
    public function index(){
    	$year = date('Y');
    	$month = date('m');
    	$cpnj = Penjualan::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->count();
    	return view('dashboard', ['cpnj' => $cpnj]);
    }
}