<?php

namespace Laz0r\Compression\Definition;

interface PurposeInterface extends FormatInterface {

	public const PURPOSE_ANYTHING = 0;
	public const PURPOSE_UTF8 = 1;
	public const PURPOSE_WOFF2 = 2;

	public function getPurpose(): int;

}

/* vi:set ts=4 sw=4 noet: */
