<?php

namespace Laz0r\Compression;

interface PluginDeviceFactoryResolverInterface {

	/**
	 * @param       string       $qcn
	 * @psalm-param class-string $qcn
	 *
	 * @return \Laz0r\Compression\DecoderFactoryInterface
	 */
	public function resolveDecoderFactory(string $qcn): DecoderFactoryInterface;

	/**
	 * @param       string       $qcn
	 * @psalm-param class-string $qcn
	 *
	 * @return \Laz0r\Compression\EncoderFactoryInterface
	 */
	public function resolveEncoderFactory(string $qcn): EncoderFactoryInterface;

}

/* vi:set ts=4 sw=4 noet: */
