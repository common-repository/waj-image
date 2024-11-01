<?php

use PHPUnit\Framework\TestCase;
use function \WaughJ\TestHashItem\TestHashItemExists;
use function \WaughJ\TestHashItem\TestHashItemString;
use function \WaughJ\TestHashItem\TestHashItemArray;
use function \WaughJ\TestHashItem\TestHashItemBool;
use function \WaughJ\TestHashItem\TestHashItemNumeric;
use function \WaughJ\TestHashItem\TestHashItemObject;
use function \WaughJ\TestHashItem\TestHashItemClass;
use function \WaughJ\TestHashItem\TestHashItemIsTrue;

class TestHashItemTest extends TestCase
{
	public function testItemExists() : void
	{
		$has_color = [ 'color' => 'red' ];
		$no_color = [];
		$this->assertEquals( TestHashItemExists( $has_color, 'color', null ), 'red' );
		$this->assertEquals( TestHashItemExists( $no_color, 'color', function( string $name ){ echo $name; } ), function( string $name ){ echo $name; } );
	}

	public function testItemString() : void
	{
		$color = [ 'color' => 'red' ];
		$number = [ 'color' => 255000000 ];
		$this->assertEquals( TestHashItemString( $color, 'color', null ), 'red' );
		$this->assertEquals( TestHashItemString( $number, 'color', false ), false );
		$this->assertEquals( TestHashItemString( $number, 'name', true ), true );
	}

	public function testItemArray() : void
	{
		$array = [ 'color' => [ 255, 0, 0 ] ];
		$number = [ 'color' => 255000000 ];
		$this->assertEquals( TestHashItemArray( $array, 'color', 'werasf' ), [ 255, 0, 0 ] );
		$this->assertEquals( TestHashItemArray( $number, 'color', 'pvpova' ), 'pvpova' );
		$this->assertEquals( TestHashItemArray( $number, 'name', 234 ), 234 );
	}

	public function testItemBool() : void
	{
		$switch1 = [ 'value' => true ];
		$switch2 = [ 'value' => 1 ];
		$this->assertEquals( TestHashItemBool( $switch1, 'value', 'cbbewa' ), true );
		$this->assertEquals( TestHashItemBool( $switch2, 'value', 'adfgdfg' ), 'adfgdfg' );
		$this->assertEquals( TestHashItemBool( $switch2, 'color', [ 2, 4, 6 ] ), [ 2, 4, 6 ] );
	}

	public function testItemNumeric() : void
	{
		$switch1 = [ 'value' => 1 ];
		$switch2 = [ 'value' => true ];
		$this->assertEquals( TestHashItemNumeric( $switch1, 'value', 'asfsfw' ), true );
		$this->assertEquals( TestHashItemNumeric( $switch2, 'value', 'dsklsdkjgl' ),'dsklsdkjgl' );
		$this->assertEquals( TestHashItemNumeric( $switch2, 'color', 'dskasdfl' ), 'dskasdfl' );
	}

	public function testItemObject() : void
	{
		$list = [ 'value' => [ 'name' => 'Guy' ] ];
		$object = [ 'value' => ( object )([ 'name' => 'Guy' ]) ];
		$this->assertEquals( TestHashItemObject( $list, 'value', 'fdhfhjj' ), 'fdhfhjj' );
		$this->assertEquals( TestHashItemObject( $object, 'value', 'dhshfhf' ), ( object )([ 'name' => 'Guy' ]) );
	}

	public function testItemClass() : void
	{
		$list = [ 'date-string' => '2018-10-22', 'date-obj' => new \DateTime( '2018-10-22' ) ];
		$this->assertEquals( TestHashItemClass( 'DateTime', $list, 'date-string', null ), null );
		$this->assertEquals( TestHashItemClass( 'DateTime', $list, 'date-obj', null ), new \DateTime( '2018-10-22' ) );
		$this->assertEquals( TestHashItemClass( \DateTime::class, $list, 'date-obj', null ), new \DateTime( '2018-10-22' ) );
		$this->assertEquals( TestHashItemClass( 'Date', $list, 'date-obj', null ), null );
	}

	public function testItemIsTrue() : void
	{
		$switch1 = [ 'value' => true ];
		$switch2 = [ 'value' => 1 ];
		$switch3 = [ 'value' => 0 ];
		$switch4 = [ 'value' => 'afdafsaf' ];
		$switch5 = [ 'value' => '' ];
		$switch6 = [ 'value' => null ];
		$switch7 = [ 'value' => false ];
		$this->assertEquals( TestHashItemIsTrue( $switch1, 'value' ), true );
		$this->assertEquals( TestHashItemIsTrue( $switch2, 'value' ), true );
		$this->assertEquals( TestHashItemIsTrue( $switch3, 'value' ), false );
		$this->assertEquals( TestHashItemIsTrue( $switch4, 'value' ), true );
		$this->assertEquals( TestHashItemIsTrue( $switch5, 'value' ), false );
		$this->assertEquals( TestHashItemIsTrue( $switch6, 'value' ), false );
		$this->assertEquals( TestHashItemIsTrue( $switch7, 'value' ), false );
	}
}
