<?php

namespace Such\NewProject;

class WhateverClass {

	public function cellIsAlive( bool $isAlive, int $numOfAliveNeighbors ): bool {
		return $isAlive && $numOfAliveNeighbors === 2 || $numOfAliveNeighbors === 3;
	}

}