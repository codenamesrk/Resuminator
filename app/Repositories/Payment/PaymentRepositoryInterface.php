<?php
namespace App\Repositories\Payment;

interface PaymentRepositoryInterface {
	public function getAll();
	public function find($id);
} 