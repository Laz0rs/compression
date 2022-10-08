<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\FormatInterface;

interface DecoderFactoryInterface {

	public function createDecoder(
		FormatInterface $Format,
		?callable $function = null
	): DecoderInterface;

}

/* vi:set ts=4 sw=4 noet: */
