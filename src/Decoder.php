<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{Format,FormatInterface};
use Laz0r\Compression\Exception\DecoderErrorException;

class Decoder extends Format implements DecoderInterface {

	/** @var callable */
	private $function;

	public function __construct(FormatInterface $Format, callable $function) {
		parent::__construct($Format->getFormat());

		$this->function = $function;
	}

	public function decode(string $data): string {
		$ret = call_user_func($this->function, $data);

		if (!is_string($ret)) {
			throw new DecoderErrorException(
				"Error occurred in \"{$this->getFormat()}\" decoder"
			);
		}

		return $ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
