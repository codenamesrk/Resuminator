<?php

namespace App\Repositories\Resume;

use App\Resume;
use App\Review;

class ResumeRepository implements ResumeRepositoryInterface {

	protected $review;

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
		$this->review = Review::whereName('not_reviewed')->first();
		return Resume::where('review_id',$this->review->id)->get();
	}

	public function getPending()
	{
		$this->review = Review::whereName('reviewing')->first();
		return Resume::where('review_id',$this->review->id)->get();
	}

	public function getCount()
	{
		return Resume::count();
	}

}