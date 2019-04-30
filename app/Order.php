<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_meja', 'id_user', 'tanggal', 'keterangan', 'status_order'
    ];

    public function get_user()
    {
        return $this->belongsTo('App\User', 'id_user', 'id_user');
    }

    public function get_meja()
    {
        return $this->belongsTo('App\Meja', 'id_meja', 'id_meja');
    }

    public function get_detail_order()
    {
        return $this->hasMany('App\DetailOrder', 'id_order', 'id_order');
    }

    public function get_transaksi()
    {
        return $this->hasMany('App\Transaksi', 'id_order', 'id_order');
    }
}
