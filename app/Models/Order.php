<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = "id";

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk', 'id_produk');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
    }
}
