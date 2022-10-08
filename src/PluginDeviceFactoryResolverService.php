<?php

namespace Laz0r\Compression;

use Laz0r\Util\AbstractConstructOnce;

class PluginDeviceFactoryResolverService extends AbstractConstructOnce implements PluginDeviceFactoryResolverInterface {

	/**
	 * @var \Laz0r\Compression\DeviceFactoryInterface[]
	 * @psalm-var array<class-string, \Laz0r\Compression\DeviceFactoryInterface>
	 */
	private array $factories = [];

	private DeviceFactoryInterface $BaseFactory;
	private PluginFactoryInterface $PluginFactory;

	public function __construct(
		DeviceFactoryInterface $BaseFactory,
		PluginFactoryInterface $PluginFactory
	) {
		parent::__construct();

		$this->BaseFactory = $BaseFactory;
		$this->PluginFactory = $PluginFactory;
	}

	public function resolveDecoderFactory(
		string $qcn
	): DecoderFactoryInterface {
		return $this->resolveDeviceFactory($qcn);
	}

	public function resolveEncoderFactory(
		string $qcn
	): EncoderFactoryInterface {
		return $this->resolveDeviceFactory($qcn);
	}

	/**
	 * @param       string       $qcn
	 * @psalm-param class-string $qcn
	 *
	 * @return \Laz0r\Compression\DeviceFactoryInterface
	 */
	protected function addDeviceFactory(string $qcn): DeviceFactoryInterface {
		$Ret = $this->createDeviceFactory($qcn);

		$this->setDeviceFactory($qcn, $Ret);

		return $Ret;
	}

	/**
	 * @param       string       $qcn
	 * @psalm-param class-string $qcn
	 *
	 * @return \Laz0r\Compression\DeviceFactoryInterface
	 */
	protected function createDeviceFactory(
		string $qcn
	): DeviceFactoryInterface {
		return $this->getPluginFactory()
			->createPlugin($qcn, $this->getBaseFactory());
	}

	protected function getBaseFactory(): DeviceFactoryInterface {
		return $this->BaseFactory;
	}

	protected function getDeviceFactory(string $qcn): ?DeviceFactoryInterface {
		return array_key_exists($qcn, $this->factories)
			? $this->factories[$qcn]
			: null;
	}

	protected function getPluginFactory(): PluginFactoryInterface {
		return $this->PluginFactory;
	}

	/**
	 * @param       string       $qcn
	 * @psalm-param class-string $qcn
	 *
	 * @return \Laz0r\Compression\DeviceFactoryInterface
	 */
	protected function resolveDeviceFactory(
		string $qcn
	): DeviceFactoryInterface {
		return $this->getDeviceFactory($qcn) ?? $this->addDeviceFactory($qcn);
	}

	/**
	 * @param       string                             $qcn
	 * @psalm-param class-string                       $qcn
	 * @param \Laz0r\Compression\DeviceFactoryInterface $DeviceFactory
	 *
	 * @return void
	 */
	protected function setDeviceFactory(
		string $qcn,
		DeviceFactoryInterface $DeviceFactory
	): void {
		$this->factories[$qcn] = $DeviceFactory;
	}

}

/* vi:set ts=4 sw=4 noet: */
