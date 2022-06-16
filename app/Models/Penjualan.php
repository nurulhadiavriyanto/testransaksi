<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model{
    use HasFactory;
    protected $table = "t_sales";
    protected $primaryKey = 'id';
    protected $fillable = ['id','kode','tgl','cust_id','subtotal','diskon','ongkir','total_bayar','created_at','updated_at'];
}