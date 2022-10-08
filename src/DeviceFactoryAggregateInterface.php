<?php

namespace Laz0r\Compression;

use Laz0r\Compression\Definition\{FormatInterface,PurposeInterface};

interface DeviceFactoryAggregateInterface extends DeviceFactoryInterface {

	public function canCreateDecoder(FormatInterface $Format): bool;

	public function canCreateEncoder(PurposeInterface $Purpose): bool;

}

/* vi:set ts=4 sw=4 noet: */
