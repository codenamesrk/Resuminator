<?php
namespace App\Repositories;

interface UserRepositoryInterface {
	public function getAll();
	public function getAllUsers();
	public function find($id);
	public function paymentsCount($id);
}