<?php

use Zizaco\Entrust\HasRole;
use Zizaco\Confide\ConfideUser;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends ConfideUser implements UserInterface, RemindableInterface {
	use HasRole;

 	public $autoPurgeRedundantAttributes = true;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	public static $rules = array();

	protected $fillable = [
		'username', 'email', 'password', 'belongs_to', 'password_confirmation'
	];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function account()
	{
		return $this->belongsTo('Lion\Account', 'account_id');
	}

	public function parent()
	{
		return $this->belongsTo('User', 'belongs_to');
	}

	public function getAccountNameAttribute()
	{
		return $this->account->name;
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

}