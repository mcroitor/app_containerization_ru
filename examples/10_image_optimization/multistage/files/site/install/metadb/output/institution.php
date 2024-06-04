<?php

namespace meta;

class institution {

/** table name constant */
	public const __name__ = 'institution';

/** table columns fields */
	public $id;
	public $name;
	public $locality_id;
	public $address;
	public $sime;
	public $language;
	public $type;
	public $isced;

/** table columns names */
	public const ID = 'id';
	public const NAME = 'name';
	public const LOCALITY_ID = 'locality_id';
	public const ADDRESS = 'address';
	public const SIME = 'sime';
	public const LANGUAGE = 'language';
	public const TYPE = 'type';
	public const ISCED = 'isced';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
