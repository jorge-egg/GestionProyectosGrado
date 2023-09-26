<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadosCalificacione
 * 
 * @property int $idPonderado
 * @property string $ponderado_item
 * @property int $pond_cal
 * 
 * @property Calificacione $calificacione
 *
 * @package App\Models
 */
class PonderadosCalificacione extends Model
{
	protected $table = 'ponderados_calificaciones';
	protected $primaryKey = 'idPonderado';
	public $timestamps = false;

	protected $casts = [
		'pond_cal' => 'int'
	];

	protected $fillable = [
		'ponderado_item',
		'pond_cal'
	];

	public function calificacione()
	{
		return $this->belongsTo(Calificacione::class, 'pond_cal');
	}
}
