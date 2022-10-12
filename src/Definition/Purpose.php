<?php

namespace Laz0r\Compression\Definition;

use Laz0r\Util\AbstractConstructOnce;

class Purpose extends AbstractConstructOnce implements PurposeInterface {

	use EqualTrait;
	use FormatTrait;
	use PurposeTrait;

	public function __construct(string $format, int $purpose) {
		parent::__construct();

		$this->format = $format;
		$this->purpose = $purpose;
	}

}

/* vi:set ts=4 sw=4 noet: */
