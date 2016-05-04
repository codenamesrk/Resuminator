<?php

namespace App\Repositories\Resume;

use App\Resume;

class ResumeRepository implements ResumeRepositoryInterface {

	public function getAll()
	{
		return Resume::orderBy('user_id')->get();
	}

	public function find($id)
	{
		return Resume::find($id);
	}

	public function getNew()
	{
		return Resume::where('review_id',1)->get();
	}

	public function getPending()
	{
		return Resume::where('review_id',2)->get();
	}

	public function getCount()
	{
		return Resume::count();
	}

}