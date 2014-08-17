<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Application extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'applications';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = array(
		'applicant',		'application_date',	'purpose', 
		'dates_activity',	'amount', 			'breakdown',
		'status',			'created_at', 		'updated_at');

	public static function updateStatus($value) {
		switch($value) {
			case 1: 
				return 'Waiting for Department';
			case 2: 
				return 'Waiting for Division';
			case 3: 
				return 'Waiting for Group';
			case 4: 
				return 'Waiting for DIFM';
			case 5: 
				return 'Waiting for SAP posting';
			case 6: 
				return 'Waiting for DIFM Head';
			case 7:
				return 'Waiting for DO Head';
			case 8:
				return 'Approved';
		}
	}

	public static function getHead($value) {
		switch($value) {
			case 1: 
				return 'depthead';
			case 2: 
				return 'divhead';
			case 3: 
				return 'grouphead';
			case 4: 
				return 'dishead';
			case 5: 
				return 'Waiting for SAP posting';
			case 6: 
				return 'Waiting for DIFM Head';
			case 7:
				return 'Waiting for DO Head';
			case 8:
				return 'Approved';
		}	
	}

}
