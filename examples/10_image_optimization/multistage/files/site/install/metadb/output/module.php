<?php

namespace meta;

class module {

/** table name constant */
	public const __name__ = 'module';

/** table columns fields */
	public $id;
	public $name;
	public $description;
	public $version;

/** table columns names */
	public const ID = 'id';
	public const NAME = 'name';
	public const DESCRIPTION = 'description';
	public const VERSION = 'version';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
