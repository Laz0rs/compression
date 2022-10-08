<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{PurposeInterface,Purpose};
use Laz0r\Compression\Exception\EncoderErrorException;

class Encoder extends Purpose implements EncoderInterface {

	/** @var callable */
	private $function;

	public function __construct(
		PurposeInterface $Purpose,
		callable $function
	) {
		parent::__construct($Purpose->getFormat(), $Purpose->getPurpose());

		$this->function = $function;
	}

	public function encode(string $data): string {
		$ret = call_user_func($this->function, $data);

		if (!is_string($ret)) {
			throw new EncoderErrorException(
				"Error occurred in \"{$this->getFormat()}\" encoder"
			);
		}

		return $ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
