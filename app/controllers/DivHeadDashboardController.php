<?php

class DivHeadDashboardController extends BaseController {

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
		$transactions = Application::where('division', '=', Auth::user()->division)
			->join('users', 'users.id', '=', 'applications.applicant')
			->get(array('applications.*', 'users.first_name', 'users.last_name'));

		foreach ($transactions as $key => &$value) {
			$value['id'] = str_pad($value['id'], 6, '0', STR_PAD_LEFT);
			$value['status'] = Application::updateStatus($value['status']);
		}
		return View::make('divhead.dashboard', array('transactions' => $transactions));
	}

	public function getTransactions($id)
	{
		$oid = $id;
		$id = (int) $id;
		$transaction = Application::where('id', '=', $id)->first();
		$transaction['numstatus'] = $transaction['status'];
		$transaction['status'] = Application::updateStatus($transaction['status']);
		$comments = ApplicationComment::where('application', '=', $id)->join('users', 'users.id', '=', 'sender')->get();
		foreach ($comments as $key => &$value) {
			$value['status'] = Application::updateStatus($value['status']);
		}
		return View::make('divhead.transaction', array('id' => $oid, 'transaction' => $transaction, 'comments' => $comments, 'transactions' => array()));
	}

	public function postTransactions($id)
	{
		$transaction = Application::where('id', '=', $id)->first();
		$data = Input::all();
		$data['status'] = $transaction->status;
		if(isset($data['approved'])) {
			$data['status'] = $transaction->status + 1;
		}
		$data['sender'] = Auth::user()->id;
		$data['application'] = (int)$id;
		$comment = ApplicationComment::create($data);
		$comment->save();
		$transaction->update(array('status' => $data['status']));
		return Redirect::to('/divhead/transactions/'.$id);

	}
}
