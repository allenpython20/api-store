<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'categoria';
	protected $primaryKey           = 'id';

	protected $returnType = 'array';
	protected $allowedFields = ['nombre','descripcion','id_usuario'];

    protected $useSoftDeletes = true;

	// Dates
	protected $useTimestamps        = true;
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	protected $validationRules = [

		'nombre' => 'required',
		'descripcion' => 'permit_empty'
	];



}
