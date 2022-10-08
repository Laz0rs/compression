<?php

namespace Laz0r\Compression;

interface PluginInterface extends DeviceFactoryInterface {

	/**
	 * @return string[]
	 */
	public static function getDecodingFormats(): array;

	/**
	 * @return string[]
	 */
	public static function getEncodingFormats(): array;

	public function __construct(DeviceFactoryInterface $BaseFactory);

}

/* vi:set ts=4 sw=4 noet: */
