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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FasesCronograma extends Model
{
	protected $table = 'fases_cronogramas';
	protected $primaryKey = 'idFase';

	protected $fillable = [
		'fase'
	];
}
