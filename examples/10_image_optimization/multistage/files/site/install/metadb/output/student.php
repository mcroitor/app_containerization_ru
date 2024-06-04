<?php

namespace meta;

class student {

/** table name constant */
	public const __name__ = 'student';

/** table columns fields */
	public $id;
	public $institution_id;
	public $firstname;
	public $lastname;
	public $sex;
	public $birth_day;
	public $birth_month;
	public $birth_year;
	public $grade;
	public $language;
	public $sen;

/** table columns names */
	public const ID = 'id';
	public const INSTITUTION_ID = 'institution_id';
	public const FIRSTNAME = 'firstname';
	public const LASTNAME = 'lastname';
	public const SEX = 'sex';
	public const BIRTH_DAY = 'birth_day';
	public const BIRTH_MONTH = 'birth_month';
	public const BIRTH_YEAR = 'birth_year';
	public const GRADE = 'grade';
	public const LANGUAGE = 'language';
	public const SEN = 'sen';

/** constructor */
	public function __construct(array|object $data) {
		foreach($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
