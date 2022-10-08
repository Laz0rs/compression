<?php

namespace Laz0r\Compression;

use ArrayIterator;
use Laz0r\Compression\Plugins\{Brotli,Identity,Zlib,Zopfli};

class PluginRegistryService extends PluginSet implements PluginRegistryInterface {

	/**
	 * @var string[]
	 * @psalm-var array<string, class-string>
	 */
	protected static $pluginsByExtension = [
		"brotli" => Brotli::class,
		"identity" => Identity::class,
		"zlib" => Zlib::class,
		"zopfli" => Zopfli::class,
	];

	public function __construct() {
		parent::__construct();

		$this->loadExtensionPlugins(static::$pluginsByExtension);
	}

	public function getDecodingPluginsByFormat(): array {
		return $this->flattenFormats($this->getDecodingFormats());
	}

	public function getEncodingPluginsByFormat(): array {
		return $this->flattenFormats($this->getEncodingFormats());
	}

	/**
	 * @param string[] $classes
	 * @param string   $method
	 *
	 * @return array[]
	 * @psalm-return array<class-string, string[]>
	 */
	protected function callMethods(array $classes, string $method): array {
		/** @var callable[] $callables */
		$callables = array_map(
			"array_merge",
			array_chunk($classes, 1),
			array_fill(0, count($classes), [$method])
		);

		/**
		 * @var string[] $ret
		 * @psalm-var array<class-string, string[]> $ret
		 */
		$ret = array_combine(
			$classes,
			array_map("call_user_func", $callables)
		);

		return $ret;
	}

	/**
	 * @param array[] $formats
	 *
	 * @return string[]
	 * @psalm-return array<string, class-string>
	 */
	protected function flattenFormats(array $formats): array {
		/**
		 * @var string[] $ret
		 * @psalm-var array<string, class-string> $ret
		 */
		$ret = [];

		/**
		 * @var string $plugin
		 * @var string[] $supports
		 */
		foreach ($formats as $plugin => $supports) {
			/** @var string $format */
			foreach ($supports as $format) {
				assert(class_exists($plugin));

				$ret[$format] = $plugin;
			}
		}

		return $ret;
	}

	/**
	 * @return array[]
	 * @psalm-return array<class-string, string[]>
	 */
	protected function getDecodingFormats(): array {
		return $this->callMethods($this->getPlugins(), "getDecodingFormats");
	}

	/**
	 * @return array[]
	 * @psalm-return array<class-string, string[]>
	 */
	protected function getEncodingFormats(): array {
		return $this->callMethods($this->getPlugins(), "getEncodingFormats");
	}

	/**
	 * @return string[]
	 */
	protected function getPlugins(): array {
		$ret = $this->toArray();

		sort($ret, SORT_STRING);

		return $ret;
	}

	/**
	 * @param string[] $plugins
	 * @psalm-param class-string[] $plugins
	 *
	 * @return void
	 */
	protected function loadArbitraryPlugins(array $plugins): void {
		iterator_apply(
			new ArrayIterator($plugins),
			[$this, "addPlugin"]
		);
	}

	/**
	 * @param string[] $plugins
	 * @psalm-param array<string, class-string> $plugins
	 *
	 * @return void
	 */
	protected function loadExtensionPlugins(array $plugins): void {
		$this->loadArbitraryPlugins(array_filter(
			$plugins,
			"extension_loaded",
			ARRAY_FILTER_USE_KEY
		));
	}

}

/* vi:set ts=4 sw=4 noet: */
