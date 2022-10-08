<?php

namespace Laz0r\Compression\Definition;

use Laz0r\Util\AbstractConstructOnce;

class Format extends AbstractConstructOnce implements FormatInterface {

	private string $format;

	public function __construct(string $format) {
		parent::__construct();

		$this->format = $format;
	}

	public function compare(object $Other): bool {
		return $this->getFormat() === $Other->getFormat();
	}

	public function getFormat(): string {
		return $this->format;
	}

}

/* vi:set ts=4 sw=4 noet: */
