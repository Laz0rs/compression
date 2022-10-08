<?php

namespace Laz0r\Compression\Definition;

use Laz0r\Util\CreateObjectTrait;

class FactoryService implements FactoryInterface {

	use CreateObjectTrait;

	protected const QCN_FORMAT = Format::class;
	protected const QCN_PURPOSE = Purpose::class;

	public function createFormat(string $format): FormatInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_FORMAT;
		$Ret = $this->createObject($qcn, $format);

		assert($Ret instanceof FormatInterface);

		return $Ret;
	}

	public function createPurpose(
		string $format,
		int $purpose
	): PurposeInterface {
		/** @psalm-var class-string $qcn */
		$qcn = static::QCN_PURPOSE;
		$Ret = $this->createObject($qcn, $format, $purpose);

		assert($Ret instanceof PurposeInterface);

		return $Ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
