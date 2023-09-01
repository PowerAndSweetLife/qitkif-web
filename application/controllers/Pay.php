<?php

class Pay extends CI_Controller {

	public function __construct()
	{
		http_response_code(404);
		exit();
		parent::__construct();
	}
	public function index() {
		payIn("test",1000);
	}
	public function collectTest()
	{
		$momo = new Momo();
		// $momo->setApiKey("test_FOdigzgSopV8GZggZa89");
		$momo->setApiKey(API_KEY);

		//Collect 500 XOF from the +22951010200 Mobile Money wallet.
		$collection = $momo
		->collect()
		->amount(600)
		->currency("XOF")
		//->from('22951010200')
		->from('2250701020304')
		->create();
		
		dump($collection);
	}

	public function depositTest() 
	{
		$momo = new Momo();
		$momo->setApiKey("test_FOdigzgSopV8GZggZa89");

		//Send 2000 XOF to the +22951010200 Mobile Money wallet.
		$deposit = $momo
		->deposit()
		->amount(2000)
		->currency("XOF")
		//->from('22951010200')
		->to('2250701020304')
		->create();
		dump($deposit->getArray());
	}
    public function collect()
    {
        $momo = new Momo();
		$momo->setApiKey(API_KEY);

		//Collect 500 XOF from the +22951010200 Mobile Money wallet.
		$transaction = $momo
		->collect()
		->amount(50000)
		->currency("XOF")
		//->from("2250501020304") // Sender phone number with country code préfix
		->from("2250701020304") // Sender phone number with country code préfix
		->firstName("Iyam") // First name of the sender
		->lastName("EVERICH");

		dump($transaction->getAmount());
		die;

		//->create();
		$status = $transaction->getStatus();
		$response = '{}';

		if ($status == "pending") {
			$response = [
			"pending" => true,
			"error" => false,
			"success" => false,
			"transaction" => $transaction->getArray()
			];
		} else {
			$response = [
			"pending" => false,
			"error" => true,
			"success" => false,
			"transaction" => $transaction->getArray(),
			];
		}

		$this->sendResponse(json_encode($response));
		if (!$response["pending"]) return;

		do {
			$transaction = $momo->getStatus($transaction->getReference());
			$status = $transaction->getStatus();

			echo $transaction->getStatusCode();

			if ($status == "error") {
				$response = [
					"pending" => false,
					"error" => true,
					"success" => false,
					"transaction" => $transaction->getArray()
				];
			} else if ($status == "success") {
				$response = [
					"pending" => false,
					"error" => false,
					"success" => true,
					"transaction" => $transaction->getArray(),
				];
			} else {
				$response = [
					"pending" => true,
					"error" => false,
					"success" => false,
					"transaction" => $transaction->getArray(),
				];
			}

			$this->sendResponse("NewStatus" . json_encode($response));
		} while ($response["pending"] == true);

    }

	public function deposit()
    {
        $momo = new Momo();
		$momo->setApiKey(API_KEY);

		//Collect 500 XOF from the +22951010200 Mobile Money wallet.
		$transaction = $momo
		->deposit()
		->amount(100000)
		->currency("XOF")
		->to('2250701020304')
		->create();
		
		dump($transaction);die;
		
		$status = $transaction->getStatus();
		$response = '{}';

		if ($status == "pending") {
			$response = [
			"pending" => true,
			"error" => false,
			"success" => false,
			"transaction" => $transaction->getArray()
			];
		} else {
			$response = [
			"pending" => false,
			"error" => true,
			"success" => false,
			"transaction" => $transaction->getArray(),
			];
		}

		$this->sendResponse(json_encode($response));
		if (!$response["pending"]) return;

		do {
			$transaction = $momo->getStatus($transaction->getReference());
			$status = $transaction->getStatus();

			echo $status;

			if ($status == "error") {
				$response = [
					"pending" => false,
					"error" => true,
					"success" => false,
					"transaction" => $transaction->getArray()
				];
			} else if ($status == "success") {
				$response = [
					"pending" => false,
					"error" => false,
					"success" => true,
					"transaction" => $transaction->getArray(),
				];
			} else {
				$response = [
					"pending" => true,
					"error" => false,
					"success" => false,
					"transaction" => $transaction->getArray(),
				];
			}

			$this->sendResponse("NewStatus" . json_encode($response));
		} while ($response["pending"] == true);

    }

	private function sendResponse($response)
	{
		dump($response);
		// ob_end_flush();
		// flush();
	}
}
