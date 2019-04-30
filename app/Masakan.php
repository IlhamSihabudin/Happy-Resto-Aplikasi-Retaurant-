<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Masakan extends Model
{
    protected $primaryKey = 'id_masakan';

    protected $fillable = [
        'nama_masakan', 'harga', 'jenis_masakan', 'gambar', 'status_masakan'
    ];
}
