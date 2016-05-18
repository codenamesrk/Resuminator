<?php

namespace App\Repositories;
use App\User;
use App\Role;
use DB;
use Carbon\Carbon;

class UserRepository implements UserRepositoryInterface {
	protected $admin;
	public function __construct()
	{
		$this->admin = User::whereEmail('admin@superuser.com')->first();
	}
	public function getAll()
	{
		return User::all();
	}
	public function getAllUsers()
	{
		return Role::with('users')->where('name','user')->get();
	}

	public function find($id)
	{
		return User::find($id);
	}
	public function paymentsCount($id)
	{
		return User::findOrFail($id)->payments()->count();
	}
	public function getUserCount()
	{		
		return User::where('id', '!=', $this->admin->id)->count();
	}
	public function getPaidUsers()
	{
		return User::where('id', '!=', $this->admin->id)->where('has_paid', 1)->count();
	}	
	public function getDropoffs($year)
	{
		// return User::where('id', '!=', 1)->where('has_paid', '!=', 1)->get();
		// return User::where('id', '!=', 1)->where('has_paid', 0)->count();
		// return DB::table('users')
		// 	->select('users.has_paid','users.created_at')
		// 	->get();
		$start = Carbon::createFromDate($year, 1, 1);
		$end = Carbon::createFromDate($year, 12, 31);
		// return $start;
		// return DB::table('users')
		// 		->where('created_at', '>=', $start)
		// 		->select( DB::raw('MONTH(created_at) as month') , DB::raw('count(*) as subscribed'), DB::raw('SUM(has_paid) as paid'))
		// 		->groupBy('month')
		// 		->get();
		return DB::table('users')
				// ->where('created_at', '>=', $start)
				// ->where('created_at', '<=', $end)
				->where('users.id', '!=', $this->admin->id)
				->whereBetween('created_at', [$start,$end])
				->select( DB::raw('MONTH(created_at) as month') , DB::raw('count(*) as subscribed'), DB::raw('SUM(has_paid) as paid'))
				->groupBy('month')
				->get();				

	}

}