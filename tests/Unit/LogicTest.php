<?php

declare( strict_types = 1 );

namespace Such\NewProject\Tests\Unit;

use PHPUnit\Framework\TestCase;

/**
 * @licence GNU GPL v2+
 */
class LogicTest extends TestCase {

	public function testDeadIfNoPop() {
		$this->assertSame(
			false,
			$this->cellAliveInNextGen(
				true,
				1
			 )
		);
	}

	private function cellAliveInNextGen( bool $isAlive, int $numberOfAliveNeighbours ): bool {
		return $numberOfAliveNeighbours === 3 || ( $isAlive && $numberOfAliveNeighbours === 2 );
	}

	/**
	 * @dataProvider aliveNeighbourCountProvider
	 */
	public function testSurvival( int $aliveNeighbours ) {
		$this->assertSame(
			true,
			$this->cellAliveInNextGen(
				true,
				$aliveNeighbours
			)
		);
	}

	public function aliveNeighbourCountProvider() {
		yield [ 2 ];
		yield [ 3 ];
	}

	/**
	 * @dataProvider notBecomingAliveNeighbourCountProvider
	 */
	public function testDeadCellRemainsDead( int $aliveNeighbours ) {
		$this->assertSame(
			false,
			$this->cellAliveInNextGen(
				false,
				$aliveNeighbours
			)
		);
	}

	public function notBecomingAliveNeighbourCountProvider() {
		yield [ 0 ];
		yield [ 1 ];
		yield [ 2 ];
		yield [ 4 ];
		yield [ 5 ];
		yield [ 6 ];
		yield [ 7 ];
		yield [ 8 ];
	}

	public function testDiesByOvercrowding() {
		$this->assertSame(
			false,
			$this->cellAliveInNextGen(
				true,
				4
			)
		);
	}

	public function testBecomesAlive() {
		$this->assertSame(
			true,
			$this->cellAliveInNextGen(
				false,
				3
			)
		);
	}

}
