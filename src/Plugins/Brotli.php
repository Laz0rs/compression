<?php

namespace Laz0r\Compression\Plugins;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\{DecoderInterface,EncoderInterface};

class Brotli extends AbstractPlugin {

	protected static int $quality = 11;

	/** @var string[] */
	private static array $formats = ["br"];

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
		assert($Format->getFormat() === "br");

		return $this->getDeviceFactory()->createDecoder(
			$Format,
			[$this, "decode"]
		);
	}

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface {
		assert($Purpose->getFormat() === "br");

		$purpose = max(0, $Purpose->getPurpose());
		$methods = ["encodeGeneric", "encodeUtf8", "encodeWoff2"];

		return $this->getDeviceFactory()->createEncoder(
			$Purpose,
			[$this, $methods[($purpose > 2 ? 0 : $purpose)]]
		);
	}

	/**
	 * @param string $data
	 *
	 * @return false|string
	 */
	public function decode(string $data) {
		/** @var false|string $ret */
		$ret = call_user_func("brotli_uncompress", $data);

		return $ret;
	}

	/**
	 * @param string $data
	 *
	 * @return false|string
	 */
	public function encodeGeneric(string $data) {
		return $this->doEncode($data, "GENERIC");
	}

	/**
	 * @param string $data
	 *
	 * @return false|string
	 */
	public function encodeUtf8(string $data) {
		return $this->doEncode($data, "TEXT");
	}

	/**
	 * @param string $data
	 *
	 * @return false|string
	 */
	public function encodeWoff2(string $data) {
		return $this->doEncode($data, "FONT");
	}

	/**
	 * @param string $data
	 * @param string $mode
	 *
	 * @return false|string
	 */
	protected function doEncode(string $data, string $mode) {
		/** @var false|string $ret */
		$ret = call_user_func(
			"brotli_compress",
			static::$quality,
			constant("BROTLI_$mode")
		);

		return $ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
