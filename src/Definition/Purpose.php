<?php

namespace Laz0r\Compression\Definition;

class Purpose extends Format implements PurposeInterface {

	private int $purpose;

	public function __construct(string $format, int $purpose) {
		parent::__construct($format);

		$this->purpose = $purpose;
	}

	public function getPurpose(): int {
		return $this->purpose;
	}

}

/* vi:set ts=4 sw=4 noet: */
