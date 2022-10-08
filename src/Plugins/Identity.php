<?php

namespace Laz0r\Compression\Plugins;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\{DecoderInterface,EncoderInterface};

class Identity extends AbstractPlugin {

	/** @var string[] */
	private static array $formats = ["identity"];

	public static function getDecodingFormats(): array {
		return self::$formats;
	}

	public static function getEncodingFormats(): array {
		return self::$formats;
	}

	public function createDecoder(
		FormatInterface $Format,
		?callable $function = null
	): DecoderInterface {
		assert($Format->getFormat() === "identity");

		return $this->getDeviceFactory()
			->createDecoder($Format, "filter_var");
	}

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface {
		assert($Purpose->getFormat() === "identity");

		return $this->getDeviceFactory()
			->createEncoder($Purpose, "filter_var");
	}

}

/* vi:set ts=4 sw=4 noet: */
