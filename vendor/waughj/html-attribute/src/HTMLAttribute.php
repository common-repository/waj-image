<?php

declare( strict_types = 1 );
namespace WaughJ\HTMLAttribute
{
	class HTMLAttribute
	{
		public function __construct( string $key, string $value )
		{
			$this->key = $key;
			$this->value = $value;
		}

		public function __toString()
		{
			return $this->GetText();
		}

		public function GetText() : string
		{
			return "{$this->key}=\"$this->value\"";
		}

		public function GetKey() : string
		{
			return $this->key;
		}

		public function GetValue() : string
		{
			return $this->value;
		}

		private $key;
		private $value;
	}
}
