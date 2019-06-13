<?php

declare( strict_types = 1 );

namespace Such\NewProject\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @licence GNU GPL v2+
 */
class AliveNeighbourCountTest extends TestCase {

	public function testParseStringAndOutputArray() {
		$this->assertSame(
			0,
			$this->countAliveNeighbours(
				[
					[ false, false, false ],
					[ false, false, false ],
					[ false, false, false ],
				],
				1,
				1
			)
		);
	}

	private function countAliveNeighbours( array $grid, int $rowIndex, int $colIndex ): int {
		return $this->oneIfTrue( $grid[1][$colIndex-1] )
			+ $this->oneIfTrue($grid[1][$colIndex+1] )
			+ $this->oneIfTrue($grid[$rowIndex-1][1] )
			+ $this->oneIfTrue($grid[$rowIndex+1][1] );
	}

	private function oneIfTrue( bool $bool ) {
		return $bool ? 1 : 0;
	}

	public function testOneNeighbour() {
		$this->assertSame(
			1,
			$this->countAliveNeighbours(
				[
					[ false, false, false ],
					[ true, false, false ],
					[ false, false, false ],
				],
				1,
				1
			)
		);
	}

	public function testTwoNeighbours() {
		$this->assertSame(
			2,
			$this->countAliveNeighbours(
				[
					[ false, false, false ],
					[ true, false, true ],
					[ false, false, false ],
				],
				1,
				1
			)
		);
	}

	public function testDoesNotCountSelf() {
		$this->assertSame(
			2,
			$this->countAliveNeighbours(
				[
					[ false, false, false ],
					[ true, true, true ],
					[ false, false, false ],
				],
				1,
				1
			)
		);
	}

	public function testOnlyNeighboursAreCounted() {
		$this->assertSame(
			2,
			$this->countAliveNeighbours(
				[
					[ false, false, false, false, false ],
					[ true, true, false, true, true ],
					[ false, false, false, false, false ],
				],
				1,
				2
			)
		);
	}

	public function testAboveAndBelowNeighboursAreCounted() {
		$this->assertSame(
			4,
			$this->countAliveNeighbours(
				[
					[ false, true, false ],
					[ true, true, true ],
					[ false, true, false ],
				],
				1,
				1
			)
		);
	}


}
