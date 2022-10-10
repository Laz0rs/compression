<?php

namespace Laz0r\Compression\Definition;

use JsonSerializable;

interface FormatInterface extends JsonSerializable {

	public const FORMAT_BROTLI = "br";
	public const FORMAT_DEFLATE = "deflate";
	public const FORMAT_GZIP = "gzip";

	/**
	 * @param \JsonSerializable $Other
	 *
	 * @return bool
	 */
	public function compare(JsonSerializable $Other): bool;

	public function getFormat(): string;

}

/* vi:set ts=4 sw=4 noet: */
