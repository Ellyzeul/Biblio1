<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class URLFormatter extends Model
{
	use HasFactory;

	private string $paginationCodeSeparator = "-";
	private array $multiplicationRates = [23, 101, 79];
	private int $prefixOffset = 110505;
	private int $midfixOffset = 5309;
	private int $suffixOffset = 95336;

	public function getPaginationCode(int $page)
	{
		$prefix = $this->prefixOffset + ($page * $this->multiplicationRates[0]);
		$midfix = $this->midfixOffset + ($page * $this->multiplicationRates[1]);
		$suffix = $this->suffixOffset + ($page * $this->multiplicationRates[2]);
		
		$code = implode($this->paginationCodeSeparator, [
			dechex($prefix), 
			dechex($midfix), 
			dechex($suffix), 
		]);

		return $code;
	}

	public function decryptPaginationCode(string $code)
	{
		$codeParts = explode($this->paginationCodeSeparator, $code);

		$prefix = hexdec($codeParts[0] ?? 0);
		$midfix = hexdec($codeParts[1] ?? 0);
		$suffix = hexdec($codeParts[2] ?? 0);

		$page = (($prefix - $this->prefixOffset) / $this->multiplicationRates[0]);
		$page = (($midfix - $this->midfixOffset) / $this->multiplicationRates[1]) == $page 
			? $page 
			: 1;
		$page = (($suffix - $this->suffixOffset) / $this->multiplicationRates[2]) == $page 
			? $page 
			: 1;

		return $page;
	}
}
