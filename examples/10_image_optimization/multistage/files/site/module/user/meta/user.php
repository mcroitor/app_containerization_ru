<?php

namespace meta;

class user {

/** table name constant */
	public const __name__ = 'user';

/** table columns fields */
	public $id;
	public $login;
	public $password;
	public $firstname;
	public $lastname;
	public $email;
	public $registration;

/** table columns names */
	public const ID = 'id';
	public const LOGIN = 'login';
	public const PASSWORD = 'password';
	public const FIRSTNAME = 'firstname';
	public const LASTNAME = 'lastname';
	public const EMAIL = 'email';
	public const REGISTRATION = 'registration';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
