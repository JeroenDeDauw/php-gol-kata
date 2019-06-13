<?php

declare( strict_types = 1 );

namespace Such\NewProject\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @licence GNU GPL v2+
 */
class InputParserTest extends TestCase {

	public function testParseStringAndOutputArray() {
		$this->assertSame(
			[
				[ true, false, false ],
				[ false, true, false ],
				[ true, false, true ],
			],
			$this->parseStringAndOutputArray( "*..\n.*.\n*.*" )
		);
	}

	private function parseStringAndOutputArray( string $string ) {
		return array_map(
			function( string $line ) {
				return array_map(
					function( string $char ): bool {
						return $char === '*';
					},
					str_split( $line )
				);
			},
			explode( "\n", $string )
		);
	}

}
