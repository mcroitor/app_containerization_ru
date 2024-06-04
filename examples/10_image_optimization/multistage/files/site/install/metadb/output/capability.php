<?php

namespace meta;

class capability {

/** table name constant */
	public const __name__ = 'capability';

/** table columns fields */
	public $id;
	public $name;
	public $descritption;

/** table columns names */
	public const ID = 'id';
	public const NAME = 'name';
	public const DESCRITPTION = 'descritption';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
