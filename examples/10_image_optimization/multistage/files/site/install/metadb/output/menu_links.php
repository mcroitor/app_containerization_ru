<?php

namespace meta;

class menu_links {

/** table name constant */
	public const __name__ = 'menu_links';

/** table columns fields */
	public $id;
	public $name;
	public $link;
	public $level;
	public $weight;

/** table columns names */
	public const ID = 'id';
	public const NAME = 'name';
	public const LINK = 'link';
	public const LEVEL = 'level';
	public const WEIGHT = 'weight';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
