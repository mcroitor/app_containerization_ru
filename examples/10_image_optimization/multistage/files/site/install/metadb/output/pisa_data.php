<?php

namespace meta;

class pisa_data {

/** table name constant */
	public const __name__ = 'pisa_data';

/** table columns fields */
	public $id;
	public $institution_id;
	public $year;
	public $nr_students;
	public $nr_students_ro;
	public $nr_students_ru;

/** table columns names */
	public const ID = 'id';
	public const INSTITUTION_ID = 'institution_id';
	public const YEAR = 'year';
	public const NR_STUDENTS = 'nr_students';
	public const NR_STUDENTS_RO = 'nr_students_ro';
	public const NR_STUDENTS_RU = 'nr_students_ru';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
