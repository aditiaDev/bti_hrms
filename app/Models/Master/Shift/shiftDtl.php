<?php

namespace App\Models\Master\Shift;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shiftDtl extends Model
{
    use HasFactory;
    protected $table = 'master_shift_dtl';
    public $timestamps = true;
    protected $guarded = [];
}
