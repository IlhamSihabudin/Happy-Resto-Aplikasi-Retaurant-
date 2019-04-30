<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    protected $primaryKey = 'id_detail_order';

    protected $fillable = [
        'id_order', 'id_masakan', 'keterangan', 'status_detail_order', 'qty', 'total_harga'
    ];

    public function get_masakan()
    {
        return $this->belongsTo('App\Masakan', 'id_masakan', 'id_masakan');
    }
}
