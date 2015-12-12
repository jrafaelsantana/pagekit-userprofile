<?php

namespace Bixie\Userprofile\Model;

use Pagekit\Application as App;
use Pagekit\System\Model\DataModelTrait;
use Pagekit\User\Model\AccessModelTrait;

/**
 * @Entity(tableClass="@userprofile_field")
 */
class Field implements \JsonSerializable {
	use AccessModelTrait, DataModelTrait, FieldModelTrait;

	/** @Column(type="integer") @Id */
	public $id;

	/** @Column(type="integer") */
	public $priority = 0;

	/** @Column(type="string") */
	public $type;

	/** @Column(type="string") */
	public $label;

	/** @Column(type="json_array") */
	public $options;

	/**
	 * @param mixed $type
	 */
	public function setType ($type) {
		$this->type = $type;
	}

	/** @var array */
	protected static $properties = [
		'prepared' => 'prepareValue'
	];

	/**
	 * {@inheritdoc}
	 * @return mixed
	 */
	public function getOptions () {

		/** @var \Bixie\Userprofile\Type\Type $type */
		$type = App::module('bixie/userprofile')->getType($this->type);

		return $type->getOptions($this);
	}

	/**
	 * {@inheritdoc}
	 * @param mixed $options
	 */
	public function setOptions ($options) {
		$this->options = $options;
	}

	/**
	 * Prepare default value before displaying form
	 * @return array
	 */
	public function prepareValue () {
		/** @var \Bixie\Userprofile\Type\Type $type */
		$type = App::module('bixie/userprofile')->getType($this->type);

		return $type->prepareValue($this, $this->get('value'));
	}

	/**
	 * {@inheritdoc}
	 */
	public function jsonSerialize () {
		$field = $this->toArray();

		$field['options'] = $this->getOptions();

		return $field;
	}

}
