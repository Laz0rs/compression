<?php

namespace Laz0r\Compression;

interface PluginFactoryInterface {

	/**
	 * @param       string                             $qcn
	 * @psalm-param class-string                       $qcn
	 * @param \Laz0r\Compression\DeviceFactoryInterface $BaseFactory
	 *
	 * @return \Laz0r\Compression\PluginInterface
	 */
	public function createPlugin(
		string $qcn,
		DeviceFactoryInterface $BaseFactory
	): PluginInterface;

}

/* vi:set ts=4 sw=4 noet: */
