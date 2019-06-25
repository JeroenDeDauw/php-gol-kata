<?php

declare( strict_types = 1 );

namespace Such\NewProject\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Such\NewProject\WhateverClass;

/**
 * @licence GNU GPL v2+
 */
class KataTest extends TestCase {

	public function testDeathCellWithNoNeighborsRemainsDeath() {
		$this->assertSame(
			false,
			$this->cellIsAlive( false, 0 )
		);
	}

	public function cellIsAlive( bool $isAlive, int $numOfAliveNeighbors ): bool {
		return $isAlive && $numOfAliveNeighbors === 2 || $numOfAliveNeighbors === 3;
	}

	public function testDeathCellWithNoOneAliveNeighbourRemainsDeath() {
		$this->assertSame(
			false,
			$this->cellIsAlive( false, 1 )
		);
	}

	public function testCellSurvivesIfThereAreTwoAliveNeighbours() {
		$this->assertSame(
			true,
			$this->cellIsAlive( true, 2 )
		);
	}

	public function testCellSurvivesIfThereAreThreeAliveNeighbours() {
		$this->assertSame(
			true,
			$this->cellIsAlive( true, 3 )
		);
	}

	public function testOvercrowdedCellDies() {
		$this->assertSame(
			false,
			$this->cellIsAlive( true, 4 )
		);
	}

	public function testDeathCellWithTwoAliveNeighbourRemainsDeath() {
		$this->assertSame(
			false,
			$this->cellIsAlive( false, 2 )
		);
	}

	public function testDeadCellWithThreeAliveNeighboursBecomesAlive() {
		$this->assertSame(
			true,
			$this->cellIsAlive( false, 3 )
		);
	}

}
