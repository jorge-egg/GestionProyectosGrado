<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Observacione
 * 
 * @property int $idObservacion
 * @property string $titulo
 * @property string $linea_invs
 * @property string $desc_problema
 * @property string $obj_general
 * @property string $obj_especificos
 * @property int $obse_cal
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Calificacione $calificacione
 *
 * @package App\Models
 */
class Observacione extends Model
{
	protected $table = 'observaciones';
	protected $primaryKey = 'idObservacion';

	protected $casts = [
		'obse_cal' => 'int'
	];

	protected $fillable = [
		'titulo',
		'linea_invs',
		'desc_problema',
		'obj_general',
		'obj_especificos',
		'obse_cal'
	];

	public function calificacione()
	{
		return $this->belongsTo(Calificacione::class, 'obse_cal');
	}
}
