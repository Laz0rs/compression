<?php

namespace Laz0r\Compression;

interface DecoderInterface extends DeviceInterface {

	public function decode(string $data): string;

}

/* vi:set ts=4 sw=4 noet: */
