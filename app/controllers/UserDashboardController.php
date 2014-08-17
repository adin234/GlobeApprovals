<?php

class UserDashboardController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$transactions = Application::where('applicant', '=', Auth::user()->id)->get();
		foreach ($transactions as $key => &$value) {
			$value['id'] = str_pad($value['id'], 6, '0', STR_PAD_LEFT);
			$value['status'] = Application::updateStatus($value['status']);
		}

		return View::make('user.dashboard', array(
			'message'		=> Session::get('message'),
			'transactions'	=> $transactions
		));
	}

	public function getApplyCA() 
	{
		return View::make('user.apply.ca', array('transactions' => array()));
	}

	public function postApplyCA() 
	{
		$data = Input::all();
		$data['applicant'] = Auth::user()->id;
		$data['status'] = 1;
		// validate the info, create rules for the inputs
		$rules = array(
			'application_date'    => 'required|date_format:"m-d-Y"',
			'purpose' => 'required|',
			'dates_activity' => 'required',
			'amount' => "required|regex:/[\d]+,?[\d]*.?[\d]{0,2}/",
			'breakdown' => 'required'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/user/apply/cash-advance')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::all()); // send back the input (not the password) so that we can repopulate the form
		} else {
			$data['application_date'] = explode('-', $data['application_date']);
			$temp = $data['application_date'][0];
			$data['application_date'][0] = $data['application_date'][1];
			$data['application_date'][1] = $temp;
			$data['application_date'] = implode('-', $data['application_date']);
			$data['application_date'] = date('Y-m-d', strtotime($data['application_date'].' 00:00:00'));
			$application = Application::create($data);
			$application->save();
			SmsSender::sendUpdate($application);
			return Redirect::to('/user/dashboard')->with('message', 'Successfully submitted request.');
		}

		return View::make('user.apply.ca', array());
	}

	public function getTransactions($id)
	{
		$oid = $id;
		$id = (int) $id;
		$transaction = Application::where('id', '=', $id)->first();
		$transaction['status'] = Application::updateStatus($transaction['status']);
		$comments = ApplicationComment::where('application', '=', $id)->join('users', 'users.id', '=', 'sender')->get();
		foreach ($comments as $key => &$value) {
			$value['status'] = Application::updateStatus($value['status']);
		}
		return View::make('user.transaction', array('id' => $oid, 'transaction' => $transaction, 'comments' => $comments, 'transactions' => array()));
	}

	public function postTransactions($id)
	{
		$transaction = Application::where('id', '=', $id)->first();
		$data = Input::all();
		$data['sender'] = Auth::user()->id;
		$data['application'] = (int)$id;
		$data['status'] = $transaction->status;
		$comment = ApplicationComment::create($data);
		$comment->save();
		return Redirect::to('/user/transactions/'.$id);

	}
}
