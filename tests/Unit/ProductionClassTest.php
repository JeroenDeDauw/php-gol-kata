<?php

declare( strict_types = 1 );

namespace Such\NewProject\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @licence GNU GPL v2+
 */
class ProductionClassTest extends TestCase {

	public function testParsingOfFullyDeadGrid() {
		$this->assertEquals(
			[
				[ false, false, false ],
				[ false, false, false ],
				[ false, false, false ],
			],
			$this->parseStringGrid( "...\n...\n..." )
		);
	}

	private function parseStringGrid( string $string ) {
		return array_map(
			function( string $line ) {
				return array_map(
					function( string $character ) {
						return $character === '*';
					},
					str_split( $line )
				);
			},
			explode("\n", $string)
		);
	}

	public function testParsingOfFullyAliveGrid() {
		$this->assertEquals(
			[
				[ true, true, true ],
				[ true, true, true ],
				[ true, true, true ],
			],
			$this->parseStringGrid( "***\n***\n***" )
		);
	}

	public function testParsingOfPartiallyAliveGrid() {
		$this->assertEquals(
			[
				[ false, true, false ],
				[ true, false, true ],
				[ false, true, false ],
			],
			$this->parseStringGrid( ".*.\n*.*\n.*." )
		);
	}

	public function testParsingOfDifferentSizeGrid() {
		$this->assertEquals(
			[
				[ false, true ],
				[ true, false ],
				[ false, true ],
			],
			$this->parseStringGrid( ".*\n*.\n.*" )
		);
	}

	public function testCellDiesInCaseOfUnderPopulation0() {
		$this->assertEquals(
			false,
			$this->cellSurvives( true, 0 )
		);
	}

	private function cellSurvives( bool $isAlive, int $neighbourCount ): bool {
		if ( $neighbourCount === 2 || $neighbourCount === 3 ) {
			return true;
		}

		return false;
	}

	public function testCellSurvives() {
		$this->assertEquals(
			true,
			$this->cellSurvives( true, 2 )
		);
	}

//	public function finalProductionCodeThing( string $inputString ) {
//		$this->outputGrid( $this->evolve( $this->parseStringGrid( $inputString ) ) );
//	}

}
