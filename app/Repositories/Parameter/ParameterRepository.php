<?php
namespace App\Repositories\Parameter;
use App\Parameter;

class ParameterRepository implements ParameterRepositoryInterface {
	public function getAll()
	{
		return Parameter::all();
	}

	public function find($id)
	{
		return Parameter::find($id);
	}

	public function getCount()
	{
		return Parameter::count();
	}
}