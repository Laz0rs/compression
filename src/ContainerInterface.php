<?php

namespace Laz0r\Compression;

interface ContainerInterface {

	public function getDecoder(string $format): DecoderInterface;

	public function getEncoder(
		string $format,
		int $purpose = 0
	): EncoderInterface;

	public function hasDecoder(string $format): bool;

	public function hasEncoder(string $format, int $purpose = 0): bool;

}

/* vi:set ts=4 sw=4 noet: */
