<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';
    protected $fillable = [
        'id_user', 'id_cart', 'name_user', 'rate'
    ];
}
