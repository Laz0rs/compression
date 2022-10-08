<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};

interface DeviceFactoryContainerInterface {

	public function getDecoderFactory(
		FormatInterface $Format
	): DecoderFactoryInterface;

	public function getEncoderFactory(
		PurposeInterface $Purpose
	): EncoderFactoryInterface;

	public function hasDecoderFactory(FormatInterface $Format): bool;

	public function hasEncoderFactory(PurposeInterface $Purpose): bool;

}

/* vi:set ts=4 sw=4 noet: */
