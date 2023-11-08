<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FasesCronograma
 * 
 * @property int $idFase
 * @property string $fase
 * @property int $fase_fech
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property FechasGrupo $fechas_grupo
 *
 * @package App\Models
 */
class FasesCronograma extends Model
{
	protected $table = 'fases_cronogramas';
	protected $primaryKey = 'idFase';

	protected $casts = [
		'fase_fech' => 'int'
	];

	protected $fillable = [
		'fase',
		'fase_fech'
	];

	public function fechas_grupo()
	{
		return $this->belongsTo(FechasGrupo::class, 'fase_fech');
	}
}
