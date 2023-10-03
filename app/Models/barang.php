<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    protected $table = 'barangs';
    protected $primarykey = 'id';
    protected $fillable = [
        'name_barang',
        'jumlah_barang',
    ];
}
