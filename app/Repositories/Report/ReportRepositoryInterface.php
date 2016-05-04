<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface {
	public function getAll();
	public function find($id);
	public function getCount();
} 