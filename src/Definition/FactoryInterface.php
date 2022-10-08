<?php

namespace Laz0r\Compression\Definition;

interface FactoryInterface {

	public function createFormat(string $format): FormatInterface;

	public function createPurpose(
		string $format,
		int $purpose
	): PurposeInterface;

}

/* vi:set ts=4 sw=4 noet: */
