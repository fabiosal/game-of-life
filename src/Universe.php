<?php
declare(strict_types=1);

namespace GOL;

use GOL\Cell;

class Universe
{

    private $length;

    /** @var Cell[][] $board */
    private $board;

    private $isEvolutionStarted = 0;

    public function __construct(int $length)
    {
        $this->length = $length;
        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length; $j++) {
                $this->board[$i][$j] = new Cell(Cell::DEAD);
            }
        }
    }

    public function getCellState(int $i, int $j)
    {

        $cell = $this->board[$i][$j];
        return $cell->getState();
    }

    public function setCellAlive(int $i, int $j)
    {
        if ($this->isEvolutionStarted) {
            return;
        }

        /** @var Cell $cell */
        $cell = $this->board[$i][$j];
        $cell->setAlive();
    }

    public function calculateNextState()
    {
        for ($i = 0; $i < $this->length; $i++) {
            for ($j = 0; $j < $this->length; $j++) {
                $numberOfAliveNeighbours = $this->calculateAliveNeighbours($i, $j);
                $this->board[$i][$j]->setNextState($numberOfAliveNeighbours);
            }
        }
        for ($i = 0; $i < $this->length; $i++) {
            for ($j = 0; $j < $this->length; $j++) {
                $this->board[$i][$j]->evolve();
            }
        }
    }

    private function calculateAliveNeighbours(int $i, int $j): int
    {
        $countAlive = 0;
        if (($i - 1) >= 0) {
            for ($z = -1; $z < 2; $z++) {
                if ($j + $z < 0 || $j + $z >= $this->length) {
                    continue;
                }
                if ($this->getCellState($i - 1, $j + $z) === Cell::ALIVE) {
                    $countAlive++;
                }
            }
        }

        if (($j - 1) >= 0) {
            if ($this->getCellState($i, $j-1) === Cell::ALIVE) {
                $countAlive++;
            }
        }
        if (($j + 1) < $this->length) {
            if ($this->getCellState($i, $j+1) === Cell::ALIVE) {
                $countAlive++;
            }
        }
        if (($i + 1) < $this->length) {
            for ($z = -1; $z < 2; $z++) {
                if ($j + $z < 0 || $j + $z >= $this->length) {
                    continue;
                }
                if ($this->getCellState($i + 1, $j + $z) === Cell::ALIVE) {
                    $countAlive++;
                }
            }
        }
        return $countAlive;
    }
}
