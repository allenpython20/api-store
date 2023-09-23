<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'usuario';
	protected $primaryKey           = 'id';

	protected $returnType = 'array';

    protected $useSoftDeletes = true;

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $validationRules = [

		'nombre' => 'required',
		'password' => 'required'
	];

	// protected $validationMessages = [

	// 	'correo' => [
	// 		'valid_email' => 'Estimado usuario, debe ingresar '
	// 	]

	// ];


}
