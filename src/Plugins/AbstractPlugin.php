<?php

namespace Laz0r\Compression\Plugins;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\{DecoderInterface,DeviceFactoryInterface};
use Laz0r\Compression\{EncoderInterface,PluginInterface};
use Laz0r\Util\AbstractConstructOnce;

/**
 * @psalm-consistent-constructor
 */
abstract class AbstractPlugin extends AbstractConstructOnce implements PluginInterface {

	private DeviceFactoryInterface $DeviceFactory;

	abstract public static function getDecodingFormats(): array;

	abstract public static function getEncodingFormats(): array;

	public function __construct(DeviceFactoryInterface $BaseFactory) {
		parent::__construct();

		$this->DeviceFactory = $BaseFactory;
	}

	abstract public function createDecoder(
		FormatInterface $Format,
		?callable $function = null
	): DecoderInterface;

	abstract public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface;

	protected function getDeviceFactory(): DeviceFactoryInterface {
		return $this->DeviceFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
