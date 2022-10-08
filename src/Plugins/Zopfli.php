<?php

namespace Laz0r\Compression\Plugins;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\Exception\MethodNotImplementedException;
use Laz0r\Compression\{DecoderInterface,EncoderInterface};

class Zopfli extends AbstractPlugin {

	public static function getDecodingFormats(): array {
		return [];
	}

	public static function getEncodingFormats(): array {
		return ["deflate", "gzip", "x-deflate", "x-gzip"];
	}

	/**
	 * @param \Laz0r\Compression\Definition\FormatInterface $Format
	 * @param ?callable                                    $function
	 *
	 * @return \Laz0r\Compression\DecoderInterface
	 * @psalm-return no-return
	 */
	public function createDecoder(
		FormatInterface $Format,
		?callable $function = null
	): DecoderInterface {
		throw new MethodNotImplementedException();
	}

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface {
		/** @var callable $func */
		$func = "zopfli_" .
			(strlen($Purpose->getFormat()) > 6 ? "compress" : "encode");

		return $this->getDeviceFactory()->createEncoder($Purpose, $func);
	}

}

/* vi:set ts=4 sw=4 noet: */
