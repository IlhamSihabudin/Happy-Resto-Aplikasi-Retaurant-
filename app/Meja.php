<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $primaryKey = 'id_meja';

    protected $fillable = [
        'no_meja', 'status_meja'
    ];
}
