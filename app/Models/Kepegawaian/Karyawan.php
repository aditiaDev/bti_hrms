<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'master_karyawan';
    public $timestamps = true;
    protected $guarded = [];
}
