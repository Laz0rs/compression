<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\PurposeInterface;

interface EncoderFactoryInterface {

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface;

}

/* vi:set ts=4 sw=4 noet: */
