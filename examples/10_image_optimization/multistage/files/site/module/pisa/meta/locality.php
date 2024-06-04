<?php

namespace meta;

class locality {

/** table name constant */
	public const __name__ = 'locality';

/** table columns fields */
	public $id;
	public $name;
	public $type;
	public $district_id;

/** table columns names */
	public const ID = 'id';
	public const NAME = 'name';
	public const TYPE = 'type';
	public const DISTRICT_ID = 'district_id';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
