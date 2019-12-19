<?php 
class Antrian extends Models 
{
	public $tablname = 'antrian';
	public $columns = [
		['field' => 'nama','type' => 'string'],
		['field' => 'status','type' => 'string'],
		['field' => 'posisi','type' => 'int']
	];
	public $primaryKey = 'id'; 
} 