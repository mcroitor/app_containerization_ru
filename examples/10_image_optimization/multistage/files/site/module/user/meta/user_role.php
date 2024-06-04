<?php

namespace meta;

class user_role {

/** table name constant */
	public const __name__ = 'user_role';

/** table columns fields */
	public $id;
	public $user_id;
	public $role_id;

/** table columns names */
	public const ID = 'id';
	public const USER_ID = 'user_id';
	public const ROLE_ID = 'role_id';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
