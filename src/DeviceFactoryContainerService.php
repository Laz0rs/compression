<?php

namespace Laz0r\Compression;

use ArrayAccess;
use ArrayObject;
use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\Exception\UnsupportedFormatException;
use Laz0r\Util\AbstractConstructOnce;
use Throwable;

class DeviceFactoryContainerService extends AbstractConstructOnce implements DeviceFactoryContainerInterface {

	private const DECODER = 0;
	private const ENCODER = 1;

	private ArrayAccess $DecoderFactories;
	private ArrayAccess $EncoderFactories;
	private PluginDeviceFactoryResolverInterface $Resolver;

	public function __construct(
		PluginDeviceFactoryResolverInterface $Resolver,
		PluginRegistryInterface $Registry
	) {
		parent::__construct();

		$this->Resolver = $Resolver;
		$this->DecoderFactories = new ArrayObject(
			$Registry->getDecodingPluginsByFormat()
		);
		$this->EncoderFactories = new ArrayObject(
			$Registry->getEncodingPluginsByFormat()
		);
	}

	public function getDecoderFactory(
		FormatInterface $Format
	): DecoderFactoryInterface {
		/** @var \Laz0r\Compression\DecoderFactoryInterface|null $Ret */
		$Ret = $this->getFactory(self::DECODER, $Format->getFormat());

		if (is_null($Ret)) {
			throw $this->createException($Format);
		}

		return $Ret;
	}

	public function getEncoderFactory(
		PurposeInterface $Purpose
	): EncoderFactoryInterface {
		/** @var \Laz0r\Compression\EncoderFactoryInterface|null $Ret */
		$Ret = $this->getFactory(self::ENCODER, $Purpose->getFormat());

		if (is_null($Ret)) {
			throw $this->createException($Purpose);
		}

		return $Ret;
	}

	public function hasDecoderFactory(FormatInterface $Format): bool {
		return $this->getDecoderFactories()->offsetExists(
			$Format->getFormat()
		);
	}

	public function hasEncoderFactory(PurposeInterface $Purpose): bool {
		return $this->getEncoderFactories()->offsetExists(
			$Purpose->getFormat()
		);
	}

	protected function createException(FormatInterface $Format): Throwable {
		return new UnsupportedFormatException(
			preg_replace("/\\W/", "", $Format->getFormat())
		);
	}

	/**
	 * @param int    $mode
	 * @param string $format
	 *
	 * @return \Laz0r\Compression\DecoderFactoryInterface|\Laz0r\Compression\EncoderFactoryInterface|null
	 */
	protected function getFactory(int $mode, string $format): ?object {
		$Ret = null;
		list($Factories, $method) = ($mode
			? [$this->getDecoderFactories(), "resolveDecoderFactory"]
			: [$this->getEncoderFactories(), "resolveEncoderFactory"]
		);

		if ($Factories->offsetExists($format)) {
			/** @psalm-var class-string $qcn */
			$qcn = $Factories->offsetGet($format);

			/** @psalm-var \Laz0r\Compression\DecoderFactoryInterface|\Laz0r\Compression\EncoderFactoryInterface $Ret */
			$Ret = call_user_func([$this->getResolver(), $method], $qcn);
		}

		return $Ret;
	}

	protected function getDecoderFactories(): ArrayAccess {
		return $this->DecoderFactories;
	}

	protected function getEncoderFactories(): ArrayAccess {
		return $this->EncoderFactories;
	}

	protected function getResolver(): PluginDeviceFactoryResolverInterface {
		return $this->Resolver;
	}

}

/* vi:set ts=4 sw=4 noet: */
