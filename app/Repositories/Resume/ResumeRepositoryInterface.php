<?php

namespace App\Repositories\Resume;

interface ResumeRepositoryInterface {
	public function getAll();
	public function find($id);
	public function getNew();
	public function getPending();
	public function getCount();
}