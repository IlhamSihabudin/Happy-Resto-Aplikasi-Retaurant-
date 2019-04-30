<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_user', 'id_order', 'tanggal', 'total_bayar'
    ];

    public function get_user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    public function get_order()
    {
        return $this->belongsTo('App\Order', 'id_order', 'id_order');
    }
}
