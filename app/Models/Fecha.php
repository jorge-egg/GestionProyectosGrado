<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fecha
 * 
 * @property int $idFecha
 * @property string $fecha
 * @property int $fech_grup
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Grupo $grupo
 *
 * @package App\Models
 */
class Fecha extends Model
{
	protected $table = 'fechas';
	protected $primaryKey = 'idFecha';

	protected $casts = [
		'fech_grup' => 'int'
	];

	protected $fillable = [
		'fecha',
		'fech_grup'
	];

	public function grupo()
	{
		return $this->belongsTo(Grupo::class, 'fech_grup');
	}
}
