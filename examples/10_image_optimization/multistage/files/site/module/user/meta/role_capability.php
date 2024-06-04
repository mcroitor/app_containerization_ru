<?php

namespace meta;

class role_capability {

/** table name constant */
	public const __name__ = 'role_capability';

/** table columns fields */
	public $id;
	public $role_id;
	public $capability_id;

/** table columns names */
	public const ID = 'id';
	public const ROLE_ID = 'role_id';
	public const CAPABILITY_ID = 'capability_id';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
