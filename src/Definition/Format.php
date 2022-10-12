<?php

namespace Laz0r\Compression\Definition;

use Laz0r\Util\AbstractConstructOnce;

class Format extends AbstractConstructOnce implements FormatInterface {

	use EqualTrait;
	use FormatTrait;

	public function __construct(string $format) {
		parent::__construct();

		$this->format = $format;
	}

}

/* vi:set ts=4 sw=4 noet: */
