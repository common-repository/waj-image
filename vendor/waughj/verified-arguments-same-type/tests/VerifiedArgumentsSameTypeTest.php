<?php

use PHPUnit\Framework\TestCase;
use WaughJ\VerifiedArgumentsSameType\VerifiedArgumentsSameType;

class VerifiedArgumentsSameTypeTest extends TestCase
{
	public function testOnlySameType()
	{
		$object = new VerifiedArgumentsSameType( [ "name" => "Jaimeson" ], [ "name" => 123 ] );
		$this->assertEquals( $object->get( "name" ), 123 );

		$second_object = new VerifiedArgumentsSameType( [ "name" => "Jaimeson" ], [ "name" => "Barry" ] );
		$this->assertEquals( $second_object->get( "name" ), "Jaimeson" );
	}
}
