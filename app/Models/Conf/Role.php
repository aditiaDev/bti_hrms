<?php

namespace App\Models\Conf;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;
  protected $table = 'conf_role';
  public $timestamps = false;
  protected $guarded = [];
}
