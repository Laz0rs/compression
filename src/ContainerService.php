<?php

namespace Laz0r\Compression;

use ArrayAccess;
use ArrayObject;
use Laz0r\Compression\Definition\FactoryInterface;
use Laz0r\Util\AbstractConstructOnce;

class ContainerService extends AbstractConstructOnce implements ContainerInterface {

	/**
	 * @var \Laz0r\Compression\DecoderInterface[]
	 * @psalm-var array<string, \Laz0r\Compression\DecoderInterface>
	 */
	private array $decoders = [];

	/**
	 * @var array[]
	 * @psalm-var array<string, \Laz0r\Compression\EncoderInterface[]>
	 */
	private array $encoders = [];

	private DeviceFactoryAggregateInterface $DeviceFactoryAggregate;
	private FactoryInterface $Factory;

	public function __construct(
		DeviceFactoryAggregateInterface $DeviceFactoryAggregate,
		FactoryInterface $Factory
	) {
		parent::__construct();

		$this->DeviceFactoryAggregate = $DeviceFactoryAggregate;
		$this->Factory = $Factory;
	}

	public function getDecoder(string $format): DecoderInterface {
		return $this->getExistingDecoder($format)
			?? $this->addDecoder($format);
	}

	public function getEncoder(
		string $format,
		int $purpose = 0
	): EncoderInterface {
		return $this->getExistingEncoder($format, $purpose)
			?? $this->addEncoder($format, $purpose);
	}

	public function hasDecoder(string $format): bool {
		return $this->hasExistingDecoder($format) ?:
			$this->getDeviceFactoryAggregate()->canCreateDecoder(
				$this->getFactory()->createFormat($format)
			);
	}

	public function hasEncoder(string $format, int $purpose = 0): bool {
		return $this->hasExistingEncoder($format, $purpose) ?:
			$this->getDeviceFactoryAggregate()->canCreateEncoder(
				$this->getFactory()->createPurpose($format, $purpose)
			);
	}

	protected function addDecoder(string $format): DecoderInterface {
		$Ret = $this->createDecoder($format);

		$this->setDecoder($format, $Ret);

		return $Ret;
	}

	protected function addEncoder(
		string $format,
		int $purpose
	): EncoderInterface {
		$Ret = $this->createEncoder($format, $purpose);

		$this->setEncoder($format, $purpose, $Ret);

		return $Ret;
	}

	protected function createDecoder(string $format): DecoderInterface {
		return $this->getDeviceFactoryAggregate()->createDecoder(
			$this->getFactory()->createFormat($format)
		);
	}

	protected function createEncoder(
		string $format,
		int $purpose
	): EncoderInterface {
		return $this->getDeviceFactoryAggregate()->createEncoder(
			$this->getFactory()->createPurpose($format, $purpose)
		);
	}

	protected function getDeviceFactoryAggregate(
	): DeviceFactoryAggregateInterface {
		return $this->DeviceFactoryAggregate;
	}

	protected function getExistingDecoder(string $format): ?DecoderInterface {
		/** @var \Laz0r\Compression\DecoderInterface|null $Ret */
		$Ret = array_key_exists($format, $this->decoders)
			? $this->decoders[$format]
			: null;

		return $Ret;
	}

	protected function getExistingEncoder(
		string $format,
		int $purpose
	): ?EncoderInterface {
		$Ret = null;

		if (array_key_exists($format, $this->encoders)
		&& array_key_exists($purpose, $this->encoders[$format])
		) {
			/** @var \Laz0r\Compression\EncoderInterface $Ret */
			$Ret = $this->encoders[$format][$purpose];
		}

		return $Ret;
	}

	protected function getFactory(): FactoryInterface {
		return $this->Factory;
	}

	protected function hasExistingDecoder(string $format): bool {
		return array_key_exists($format, $this->decoders);
	}

	protected function hasExistingEncoder(string $format, int $purpose): bool {
		return array_key_exists($format, $this->encoders)
			&& array_key_exists($purpose, $this->encoders[$format]);
	}

	protected function setDecoder(
		string $format,
		DecoderInterface $Decoder
	): void {
		$this->decoders[$format] = $Decoder;
	}

	protected function setEncoder(
		string $format,
		int $purpose,
		EncoderInterface $Encoder
	): void {
		$this->encoders[$format] ??= [];
		$this->encoders[$format][$purpose] = $Encoder;
	}

}

/* vi:set ts=4 sw=4 noet: */
