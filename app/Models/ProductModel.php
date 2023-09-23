<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'producto';
	protected $primaryKey           = 'id';

	protected $returnType = 'array';
	protected $allowedFields = ['nombre','descripcion','precio','stock','id_usuario','id_categoria'];
	protected $hidden = ['id','nombre','descripcion','precio','stock'];

    protected $useSoftDeletes = true;

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $validationRules = [

		'nombre' => 'required',
		'descripcion' => 'required',
		'precio' => 'required',
		'stock' => 'required',
        'id_usuario' => 'required',
	];

	// protected $validationMessages = [

	// 	'correo' => [
	// 		'valid_email' => 'Estimado usuario, debe ingresar '
	// 	]

	// ];


}
