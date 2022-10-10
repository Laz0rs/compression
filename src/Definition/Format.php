<?php

namespace Laz0r\Compression\Definition;

use JsonSerializable;
use Laz0r\Util\AbstractConstructOnce;

class Format extends AbstractConstructOnce implements FormatInterface {

	private string $format;

	public function __construct(string $format) {
		parent::__construct();

		$this->format = $format;
	}

	public function compare(JsonSerializable $Other): bool {
		return $this->jsonSerialize() === $Other->jsonSerialize();
	}

	public function getFormat(): string {
		return $this->format;
	}

	public function jsonSerialize() {
		return get_object_vars($this);
	}

}

/* vi:set ts=4 sw=4 noet: */
