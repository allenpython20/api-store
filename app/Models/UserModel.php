<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'usuario';
	protected $primaryKey           = 'id';

	protected $returnType = 'array';
	protected $allowedFields = ['username','password','email','nombre','id_rol','token'];
    protected $useSoftDeletes = true;

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $validationRules = [

		'username' => 'required|is_unique[usuario.username,id,{id}]',
		'password' => 'required|min_length[4]',
		'id_rol' => 'required|is_valid_rol',
		'id' => 'permit_empty|integer'
	];

	protected $validationMessages = [

		'id_rol' => [
			'is_valid_rol' => "El id del rol no existe "
		],
		'username' => [
			'is_unique' => 'Ya existe el username ingresado'
		]

	];


}
