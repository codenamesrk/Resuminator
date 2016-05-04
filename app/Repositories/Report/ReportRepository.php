<?php

namespace App\Repositories\Report;
use App\Report;

class ReportRepository implements ReportRepositoryInterface {
	public function getAll()
	{
		return Report::all();
	}
	public function find($id)
	{
		return Report::find($id);
	}
	public function getCount()
	{
		return Report::count();
	}
} 