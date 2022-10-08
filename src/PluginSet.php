<?php

namespace Laz0r\Compression;

use Laz0r\Util\AbstractConstructOnce;
use Laz0r\Util\{Set,SetInterface};

class PluginSet extends AbstractConstructOnce implements PluginSetInterface {

	private SetInterface $Set;

	public function __construct(?SetInterface $Set = null) {
		parent::__construct();

		$Set ??= new Set();

		$Set->clear();

		$this->Set = $Set;
	}

	public function addPlugin(string $qcn): void {
		$this->Set->add($qcn);
	}

	public function hasPlugin(string $qcn): bool {
		return $this->Set->contains($qcn);
	}

	public function removePlugin(string $qcn): void {
		$this->Set->remove($qcn);
	}

	/**
	 * @return string[]
	 */
	protected function toArray(): array {
		/** @var string[] $ret */
		$ret = $this->Set->toArray();

		return $ret;
	}

}

/* vi:set ts=4 sw=4 noet: */
