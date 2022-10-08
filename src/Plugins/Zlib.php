<?php

namespace Laz0r\Compression\Plugins;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\{DecoderInterface,EncoderInterface};

class Zlib extends AbstractPlugin {

	protected static int $level = 9;

	/** @var string[] */
	private static array $formats = ["deflate", "gzip", "x-deflate", "x-gzip"];

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
		return $this->getDeviceFactory()->createDecoder(
			$Format,
			(strlen($Format->getFormat()) > 6 ? "gzuncompress" : "gzdecode")
		);
	}

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface {
		return $this->getDeviceFactory()->createEncoder(
			$Purpose,
			[$this, (strlen($Purpose->getFormat()) > 6 ? "deflate" : "gzip")]
		);
	}

	/**
	 * @param string $data
	 *
	 * @return false|string
	 */
	public function deflate(string $data) {
		/** @var false|string $ret */
		$ret = call_user_func(
			"gzcompress",
			$data,
			static::$level,
			constant("ZLIB_ENCODING_DEFLATE")
		);

		return $ret;
	}

	/**
	 * @param string $data
	 *
	 * @return false|string
	 */
	public function gzip(string $data) {
		/** @var false|string $ret */
		$ret = call_user_func(
			"gzencode",
			$data,
			static::$level,
			constant(
				defined("FORCE_GZIP") ? "FORCE_GZIP" : "ZLIB_ENCODING_GZIP"
			)
		);

		return $ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
