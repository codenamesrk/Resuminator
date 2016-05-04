<?php
namespace App\Repositories\Payment;
use App\Payment;

class PaymentRepository implements PaymentRepositoryInterface {
	public function getAll()
	{
		return Payment::all();
	}

	public function find($id)
	{
		return Payment::find($id);
	}
}