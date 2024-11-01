<?php

declare( strict_types = 1 );
namespace WaughJ\VerifiedArgumentsSameType
{
	use WaughJ\VerifiedArguments\VerifiedArguments;

	class VerifiedArgumentsSameType extends VerifiedArguments
	{
		public function __construct( array $args, array $defaults )
		{
			$formatted_defaults = [];
			foreach ( $defaults as $default_key => $default_value )
			{
				$formatted_defaults[ $default_key ] = [ "value" => $default_value, "type" => self::getType( $default_value ) ];
			}
			parent::__construct( $args, $formatted_defaults );
		}

		private static function getType( $tested ) : string
		{
			if ( is_object( $tested ) )
			{
				return get_class( $tested );
			}
			return gettype( $tested );
		}
	}
}
