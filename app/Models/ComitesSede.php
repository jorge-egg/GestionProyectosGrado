<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ComitesSede
 * 
 * @property int $idComite
 * @property string $nombre
 * @property int $comi_sede
 * 
 * @property Sede $sede
 *
 * @package App\Models
 */
class ComitesSede extends Model
{
	protected $table = 'comites_sedes';
	protected $primaryKey = 'idComite';
	public $timestamps = false;

	protected $casts = [
		'comi_sede' => 'int'
	];

	protected $fillable = [
		'nombre',
		'comi_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'comi_sede');
	}
}
