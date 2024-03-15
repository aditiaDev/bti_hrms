<?php

namespace App\Models\Conf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCode extends Model
{
    use HasFactory;
    protected $table = 'conf_master_code';
    public $timestamps = false;
    protected $guarded = [];
}
