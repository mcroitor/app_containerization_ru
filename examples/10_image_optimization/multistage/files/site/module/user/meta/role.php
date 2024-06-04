<?php

namespace meta;

class role {

/** table name constant */
	public const __name__ = 'role';

/** table columns fields */
	public $id;
	public $name;
	public $description;

/** table columns names */
	public const ID = 'id';
	public const NAME = 'name';
	public const DESCRIPTION = 'description';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
