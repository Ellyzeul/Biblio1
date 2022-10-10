<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Quote extends Model
{
	use HasFactory;

	public function read()
	{
		$result = DB::table("quotes")
			->select("quote", "author")
			->get()
			->random();
		
		return $result;
	}
}
