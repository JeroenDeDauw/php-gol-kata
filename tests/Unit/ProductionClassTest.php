<?php

declare( strict_types = 1 );

namespace Such\NewProject\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @licence GNU GPL v2+
 */
class ProductionClassTest extends TestCase {

	public function testGivenNoAliveCells_returnsZero() {
		$this->assertSame(
			0,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0 ],
					[ 0, 0, 0 ],
					[ 0, 0, 0 ]
				],
				1,
				1
			)
		);
	}

	private function numberOfAliveNeighbours(array $grid, $row, $column ) {
		$columnToTheLeft = $column === 0 ? count( $grid[0] ) - 1 : $column - 1;
		$columnToTheRight = $column === count( $grid[0] ) - 1 ? 0 : $column + 1;
		$rowToTheTop = $row === 0 ? count( $grid ) - 1 : $row - 1;
		$rowToTheBottom = $row === count( $grid ) - 1 ? 0 : $row + 1;

		return $grid[$rowToTheTop][$columnToTheLeft] + $grid[$rowToTheTop][$column] + $grid[$rowToTheTop][$columnToTheRight]
			+ $grid[$row][$columnToTheLeft] + $grid[$row][$columnToTheRight]
			+ $grid[$rowToTheBottom][$columnToTheLeft] + $grid[$rowToTheBottom][$column] + $grid[$rowToTheBottom][$columnToTheRight];
	}

	public function testGivenOneAliveNeighbor_returnsOne() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0 ],
					[ 1, 0, 0 ],
					[ 0, 0, 0 ]
				],
				1,
				1
			)
		);
	}

	public function testTwoAliveNeighbours() {
		$this->assertSame(
			2,
			$this->numberOfAliveNeighbours(
				[
					[ 1, 0, 0 ],
					[ 1, 0, 0 ],
					[ 0, 0, 0 ]
				],
				1,
				1
			)
		);
	}

	public function testZeroAliveNeighborsInTopRow() {
		$this->assertSame(
			0,
			$this->numberOfAliveNeighbours(
				[
					[ 1, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ]
				],
				2,
				2
			)
		);
	}

	public function testFirstCellInFirstRow() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 1, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ]
				],
				0,
				0
			)
		);
	}

	public function testOnlyCellsDirectlyToTheLeftAreCounted() {
		$this->assertSame(
			2,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 1, 0, 0 ],
					[ 0, 1, 0, 0 ],
					[ 0, 0, 0, 0 ]
				],
				2,
				2
			)
		);
	}

	public function testCellToLeftBottomIsCounted() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 1, 0, 0 ]
				],
				2,
				2
			)
		);
	}

	public function testCellToTheTopIsCounted() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 0, 1, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ]
				],
				2,
				2
			)
		);
	}

	public function testCellsToTheRightAreCounted() {
		$this->assertSame(
			3,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 1 ],
					[ 0, 0, 0, 1 ],
					[ 0, 0, 0, 1 ]
				],
				2,
				2
			)
		);
	}

	public function testCellsToTheBottomAreCounted() {
		$this->assertSame(
			3,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 1, 1, 1 ]
				],
				2,
				2
			)
		);
	}

	public function testCellsOnTheRight() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 1, 0, 0, 0 ],
					[ 0, 0, 0, 0 ]
				],
				2,
				3
			)
		);
	}

	public function testCellsOnTheBottom() {
		$this->assertSame(
			3,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 1, 1, 1 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ]
				],
				3,
				2
			)
		);
	}

	public function testVerticalRowNumber() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0 ],
					[ 0, 0, 0 ],
					[ 0, 0, 1 ],
					[ 0, 0, 0 ],
				],
				3,
				1
			)
		);
	}

	public function testHorizontalColumnNumber() {
		$this->assertSame(
			1,
			$this->numberOfAliveNeighbours(
				[
					[ 0, 0, 0, 0 ],
					[ 0, 0, 0, 0 ],
					[ 0, 0, 1, 0 ],
				],
				1,
				3
			)
		);
	}

	public function testEightAliceNeighbours() {
		$this->assertSame(
			8,
			$this->numberOfAliveNeighbours(
				[
					[ 1, 1, 1, 1 ],
					[ 1, 1, 1, 1 ],
					[ 1, 1, 1, 1 ],
					[ 1, 1, 1, 1 ],
				],
				2,
				2
			)
		);
	}

}
