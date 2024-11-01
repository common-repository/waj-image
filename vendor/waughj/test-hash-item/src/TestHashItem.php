<?php

declare( strict_types = 1 );
namespace WaughJ\TestHashItem
{
	function TestHashItemExists( array $list, string $key, $fallback = null )
	{
		return ( array_key_exists( $key, $list ) ) ? $list[ $key ] : $fallback;
	}

	function TestHashItemString( array $list, string $key, $fallback = null )
	{
		return TestHashItem( 'is_string', $list, $key, $fallback );
	}

	function TestHashItemArray( array $list, string $key, $fallback = null )
	{
		return TestHashItem( 'is_array', $list, $key, $fallback );
	}

	function TestHashItemBool( array $list, string $key, $fallback = null )
	{
		return TestHashItem( 'is_bool', $list, $key, $fallback );
	}

	function TestHashItemNumeric( array $list, string $key, $fallback = null )
	{
		return TestHashItem( 'is_numeric', $list, $key, $fallback );
	}

	function TestHashItemObject( array $list, string $key, $fallback = null )
	{
		return TestHashItem( 'is_object', $list, $key, $fallback );
	}

	function TestHashItemClass( string $class, array $list, string $key, $fallback = null )
	{
		return TestHashItem
		(
			function( $value ) use ( $class ): bool
			{
				return is_a( $value, $class );
			},
			$list,
			$key,
			$fallback
		);
	}

	function TestHashItemIsTrue( array $list, string $key ) : bool
	{
		return TestHashItemExists( $list, $key ) && $list[ $key ];
	}

	function TestHashItem( callable $function, array $list, string $key, $fallback = null )
	{
		return ( TestHashItemExists( $list, $key, false ) && $function( $list[ $key ] ) ) ? $list[ $key ] : $fallback;
	}
}
