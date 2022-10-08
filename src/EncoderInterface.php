<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\PurposeInterface;

interface EncoderInterface extends DeviceInterface, PurposeInterface {

	public function encode(string $data): string;

}

/* vi:set ts=4 sw=4 noet: */
