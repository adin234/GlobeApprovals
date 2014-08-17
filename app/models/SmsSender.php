<?php
	include_once __DIR__.'/../../globe/GlobeApi.php';

	class SmsSender {

		public static function sendUpdate($application) {
				SmsSender::updateApplicant($application);
				$globe = new GlobeApi();
				$auth = $globe->Globeauth(
					'zeqXI95BEoC7kTR4LjiB8GCdXeL8I5dM',
					'282a8e9bb9617b308387b6cff5a3e136452c6a1a7c2705bef882b56cf47d4431'
				);
				$sms = $globe->sms(3184);
				$token = SmsSender::getRecepient($application->applicant, $application->status);
				if($token) {
					$message = 'Being the '.$token['position'].' head. Please work on application '.$application->id.' by '.$token['user']['first_name']
						.' '.$token['user']['last_name'];
					$response = $sms->sendMessage($token['token'], $token['number'], $message);
				}
		}

		public static function updateComment($comment, $application) {
			$globe = new GlobeApi();
			$auth = $globe->Globeauth(
				'zeqXI95BEoC7kTR4LjiB8GCdXeL8I5dM',
				'282a8e9bb9617b308387b6cff5a3e136452c6a1a7c2705bef882b56cf47d4431'
			);
			$sms = $globe->sms(3184);
			$token = User::where('id', '=', $application->applicant)->first();
			$head = Application::getHead($application->status);
			$position = '';
			switch($head) {
				case 'depthead':
					$position = 'department';
					break;
				case 'grouphead':
					$position = 'group';
					break;
				case 'divhead':
					$position = 'division';
					break;
			}
			if($token) {
				$message = 'The '.$position.' head just commented "'
					.$comment.'"';
				$response = $sms->sendMessage($token->access_token, $token->mobile, $message);
			}
		}

		public static function updateApplicant($application) {
			$globe = new GlobeApi();
			$auth = $globe->Globeauth(
				'zeqXI95BEoC7kTR4LjiB8GCdXeL8I5dM',
				'282a8e9bb9617b308387b6cff5a3e136452c6a1a7c2705bef882b56cf47d4431'
			);
			$sms = $globe->sms(3184);
			$token = User::where('id', '=', $application->applicant)->first();
			if($token) {
				$message = 'Your application just went up the process tree, it is now '
					.Application::updateStatus($application->status);
				$response = $sms->sendMessage($token->access_token, $token->mobile, $message);
			}
		}

		public static function getRecepient($id, $status) {
			$head = Application::getHead($status);
			switch($head) {
				case 'depthead':
					$search = 'department';
					break;
				case 'grouphead':
					$search = 'group';
					break;
				case 'divhead':
					$search = 'division';
					break;
			}
			$applicant = User::where('id', '=', $id)->first();
			if(isset($search)) {
				$user = User::where('head', '=', $head)->where($search, '=', $applicant->$search)->first();
				return array('number' => $user->mobile, 'token' => $user->access_token, 'user'=>$applicant, 'position' => $search);
			}
			return null;
		}
	}