<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $numeroDocumento
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $numeroCelular
 * @property int $usua_sede
 * 
 * @property Sede $sede
 * @property Collection|Programa[] $programas
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuarios';
	protected $primaryKey = 'numeroDocumento';
	public $timestamps = false;

	protected $casts = [
		'usua_sede' => 'int'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'email',
		'numeroCelular',
		'usua_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'usua_sede');
	}

	public function programas()
	{
		return $this->hasMany(Programa::class, 'prog_usua');
	}
}
