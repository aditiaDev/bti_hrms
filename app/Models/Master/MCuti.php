<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCuti extends Model
{
    use HasFactory;
    protected $table = 'master_cuti';
    public $timestamps = false;
    protected $guarded = [];
}
