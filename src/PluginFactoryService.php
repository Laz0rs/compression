<?php

namespace Laz0r\Compression;

use Laz0r\Util\CreateObjectTrait;

class PluginFactoryService implements PluginFactoryInterface {

	use CreateObjectTrait;

	public function createPlugin(
		string $qcn,
		DeviceFactoryInterface $BaseFactory
	): PluginInterface {
		assert(is_a($qcn, PluginInterface::class, true));

		$Ret = $this->createObject($qcn, $BaseFactory);

		assert($Ret instanceof PluginInterface);

		return $Ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
