<?php

namespace Laz0r\Compression;

interface PluginRegistryInterface extends PluginSetInterface {

	/**
	 * @return array
	 * @psalm-return array<string, class-string>
	 */
	public function getDecodingPluginsByFormat(): array;

	/**
	 * @return array
	 * @psalm-return array<string, class-string>
	 */
	public function getEncodingPluginsByFormat(): array;

}

/* vi:set ts=4 sw=4 noet: */
