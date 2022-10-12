<?php

namespace Laz0r\Compression\Definition;

use JsonSerializable;

trait EqualTrait {

	public function equals(?object $Other): bool {
		assert(is_null($Other) || ($Other instanceof JsonSerializable));

		return !is_null($Other) && (
			($Other === $this) || (
				(get_class($Other) === get_class($this)) &&
				($this->jsonSerialize() === $Other->jsonSerialize())
			)
		);
	}

	public function jsonSerialize() {
		return get_object_vars($this);
	}

}

/* vi:set ts=4 sw=4 noet: */
