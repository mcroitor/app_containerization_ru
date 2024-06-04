<?php

namespace meta;

class sqlite_sequence {

/** table name constant */
	public const __name__ = 'sqlite_sequence';

/** table columns fields */
	public $name;
	public $seq;

/** table columns names */
	public const NAME = 'name';
	public const SEQ = 'seq';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
