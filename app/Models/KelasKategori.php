<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasKategori extends Model
{
    use HasFactory;
    protected $table = 'kelas_kategoris';
    protected $primarykey = 'id';
    protected $fillable = [
        'name',
        'description',
    ];
}
