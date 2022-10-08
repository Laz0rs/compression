<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Util\AbstractConstructOnce;

class DeviceFactoryAggregateService extends AbstractConstructOnce implements DeviceFactoryAggregateInterface {

	private DeviceFactoryContainerInterface $Container;

	public function __construct(DeviceFactoryContainerInterface $Container) {
		parent::__construct();

		$this->Container = $Container;
	}

	public function canCreateDecoder(FormatInterface $Format): bool {
		return $this->getContainer()->hasDecoderFactory($Format);
	}

	public function canCreateEncoder(PurposeInterface $Purpose): bool {
		return $this->getContainer()->hasEncoderFactory($Purpose);
	}

	public function createDecoder(
		FormatInterface $Format,
		?callable $function = null
	): DecoderInterface {
		return $this->getContainer()
			->getDecoderFactory($Format)
			->createDecoder($Format);
	}

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface {
		return $this->getContainer()
			->getEncoderFactory($Purpose)
			->createEncoder($Purpose);
	}

	protected function getContainer(): DeviceFactoryContainerInterface {
		return $this->Container;
	}

}

/* vi:set ts=4 sw=4 noet: */
