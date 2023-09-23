<?php

namespace App\Models;

use CodeIgniter\Model;

class RolModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'rol';
	protected $primaryKey           = 'id';

	protected $returnType = 'array';

    //protected $useSoftDeletes = true;

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	// protected $deletedField         = 'deleted_at';

	protected $validationRules = [

	
	];

	// protected $validationMessages = [

	// 	'correo' => [
	// 		'valid_email' => 'Estimado usuario, debe ingresar '
	// 	]

	// ];


}
