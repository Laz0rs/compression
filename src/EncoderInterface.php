<?php

namespace Laz0r\Compression;

interface EncoderInterface extends DeviceInterface {

	public function encode(string $data): string;

	public function getPurpose(): int;

}

/* vi:set ts=4 sw=4 noet: */
