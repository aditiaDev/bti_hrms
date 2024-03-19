<?php

namespace App\Models\Kepegawaian;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTransferEmp extends Model
{
	use HasFactory;
	protected $table = 'history_transfer_employee';
	const UPDATED_AT = null;
	// public $timestamps = true;
	protected $guarded = [];
}
