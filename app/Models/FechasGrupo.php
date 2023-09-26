<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FechasGrupo
 * 
 * @property int $idFecha
 * @property string $fecha
 * @property int $fech_grup
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property GruposCronograma $grupos_cronograma
 *
 * @package App\Models
 */
class FechasGrupo extends Model
{
	protected $table = 'fechas_grupos';
	protected $primaryKey = 'idFecha';

	protected $casts = [
		'fech_grup' => 'int'
	];

	protected $fillable = [
		'fecha',
		'fech_grup'
	];

	public function grupos_cronograma()
	{
		return $this->belongsTo(GruposCronograma::class, 'fech_grup');
	}
}
