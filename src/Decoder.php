<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{FormatInterface, FormatTrait};
use Laz0r\Compression\Exception\DecoderErrorException;
use Laz0r\Util\AbstractConstructOnce;

class Decoder extends AbstractConstructOnce implements DecoderInterface {

	use FormatTrait;

	/** @var callable */
	private $function;

	public function __construct(FormatInterface $Format, callable $function) {
		parent::__construct();

		$this->format = $Format->getFormat();
		$this->function = $function;
	}

	public function decode(string $data): string {
		$ret = call_user_func($this->function, $data);

		if (!is_string($ret)) {
			throw new DecoderErrorException(sprintf(
				"Error occurred in \"%s\" decoder",
				$this->getFormat(),
			));
		}

		return $ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
