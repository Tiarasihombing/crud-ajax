<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class level_kelas extends Model
{
    use HasFactory;
    protected $table = 'level_kelas';
    protected $primarykey = 'id';
    protected $fillable = [
        'name'
    ];
}
