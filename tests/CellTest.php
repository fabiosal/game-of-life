<?php

use PHPUnit\Framework\TestCase;
use GOF\Cell;

class CellTest extends TestCase
{

    public function testCellCreationStatus()
    {
        $cell = new Cell(Cell::ALIVE);
        $this->assertEquals(Cell::ALIVE, $cell->getState());

        $cell = new Cell(Cell::DEAD);
        $this->assertEquals(Cell::DEAD, $cell->getState());
    }

    /**
     * @dataProvider NeighbourForAliveToDead
     */
    public function testEvolvingCellAliveToDead($numberOfAliveNeighbours)
    {

        $cell = new Cell(Cell::ALIVE);
        $cell->setNextState($numberOfAliveNeighbours);
        $this->assertEquals(Cell::DEAD, $cell->getNextState());
    }

    public function NeighbourForAliveToDead()
    {
        return [[0], [1], [4], [5], [6], [7], [8]];
    }

    /**
     * @dataProvider NeighbourForAliveToAlive
     */
    public function testEvolvingCellAliveToAlive($numberOfAliveNeighbours)
    {

        $cell = new Cell(Cell::ALIVE);
        $cell->setNextState($numberOfAliveNeighbours);
        $this->assertEquals(Cell::ALIVE, $cell->getNextState());
    }

    public function NeighbourForAliveToAlive()
    {
        return [[2], [3]];
    }

    /**
     * @dataProvider NeighbourForDeadToAlive
     */
    public function testEvolvingCellDeadToAlive($numberOfAliveNeighbours)
    {

        $cell = new Cell(Cell::DEAD);
        $cell->setNextState($numberOfAliveNeighbours);
        $this->assertEquals(Cell::ALIVE, $cell->getNextState());
    }

    public function NeighbourForDeadToAlive()
    {
        return [[3]];
    }

    /**
     * @dataProvider NeighbourForDeadToDead
     */
    public function testEvolvingCellDeadToDead($numberOfAliveNeighbours)
    {

        $cell = new Cell(Cell::DEAD);
        $cell->setNextState($numberOfAliveNeighbours);
        $this->assertEquals(Cell::DEAD, $cell->getNextState());
    }

    public function NeighbourForDeadToDead()
    {
        return [[0], [1], [2], [4], [5], [6], [7], [8]];
    }


    public function testCellEvolution()
    {
        $cell = new Cell(Cell::ALIVE);
        $cell->setNextState(0);
        $cell->evolve();
        $this->assertEquals(Cell::DEAD, $cell->getState());
        $this->assertEquals(null, $cell->getNextState());
    }
}
