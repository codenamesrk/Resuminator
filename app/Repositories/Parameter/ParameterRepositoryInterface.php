<?php
namespace App\Repositories\Parameter;

interface ParameterRepositoryInterface {
	public function getAll();
	public function find($id);
	public function getCount();
} 