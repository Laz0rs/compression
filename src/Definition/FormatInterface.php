<?php

namespace Laz0r\Compression\Definition;

interface FormatInterface {

	public const FORMAT_BROTLI = "br";
	public const FORMAT_DEFLATE = "deflate";
	public const FORMAT_GZIP = "gzip";

	/**
	 * @param static $Other
	 *
	 * @return bool
	 */
	public function compare(object $Other): bool;

	public function getFormat(): string;

}

/* vi:set ts=4 sw=4 noet: */
