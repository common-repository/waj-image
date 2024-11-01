<?php

use PHPUnit\Framework\TestCase;

class HTMLAttributeTest extends TestCase
{
	public function testIsThereAnySyntaxError()
	{
		$attribute = new WaughJ\HTMLAttribute\HTMLAttribute( 'something', 'other' );
		$this->assertTrue( is_object( $attribute ) );
	}

	public function testIsAttributeHTMLCorrect()
	{
		$attribute = new WaughJ\HTMLAttribute\HTMLAttribute( 'class', 'footer' );
		$this->assertEquals( $attribute->GetText(), 'class="footer"' );
	}
}
