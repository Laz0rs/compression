<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{
	FormatTrait,
	PurposeInterface,
	PurposeTrait
};
use Laz0r\Compression\Exception\EncoderErrorException;
use Laz0r\Util\AbstractConstructOnce;

class Encoder extends AbstractConstructOnce implements EncoderInterface {

	use FormatTrait;
	use PurposeTrait;

	/** @var callable */
	private $function;

	public function __construct(
		PurposeInterface $Purpose,
		callable $function
	) {
		parent::__construct();

		$this->format = $Purpose->getFormat();
		$this->function = $function;
		$this->purpose = $Purpose->getPurpose();
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
