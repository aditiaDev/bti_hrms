<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    use HasFactory;
    protected $table = 'list_libur';
    public $timestamps = true;
    protected $guarded = [];
}
