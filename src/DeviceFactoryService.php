<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};
use Laz0r\Compression\Exception\InvalidArgumentException;
use Laz0r\Util\CreateObjectTrait;
use Throwable;

class DeviceFactoryService implements DeviceFactoryInterface {

	use CreateObjectTrait;

	protected const QCN_DECODER = Decoder::class;
	protected const QCN_ENCODER = Encoder::class;

	public function createDecoder(
		FormatInterface $Format,
		?callable $function = null
	): DecoderInterface {
		if (is_null($function)) {
			throw $this->createException();
		}

		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_DECODER;
		$Ret = $this->createObject($qcn, $Format, $function);

		assert($Ret instanceof DecoderInterface);

		return $Ret;
	}

	public function createEncoder(
		PurposeInterface $Purpose,
		?callable $function = null
	): EncoderInterface {
		if (is_null($function)) {
			throw $this->createException();
		}

		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_ENCODER;
		$Ret = $this->createObject($qcn, $Purpose, $function);

		assert($Ret instanceof EncoderInterface);

		return $Ret;
	}

	protected function createException(): Throwable {
		return new InvalidArgumentException("\$function must not be null");
	}

}

/* vi:set ts=4 sw=4 noet: */
