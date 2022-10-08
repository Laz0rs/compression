<?php

namespace Laz0r\Compression;

interface PluginSetInterface {

	public function addPlugin(string $qcn): void;

	public function hasPlugin(string $qcn): bool;

	public function removePlugin(string $qcn): void;

}

/* vi:set ts=4 sw=4 noet: */
