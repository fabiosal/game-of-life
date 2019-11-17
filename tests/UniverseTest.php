<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GOF\Universe;
use GOF\Cell;

class UniverseTest extends TestCase
{

    public function testUniverseCreationAllDead()
    {
        $length = 4;
        $universe = new Universe($length);
        for ($i = 0; $i < $length; $i++) {
            for ($j = 0; $j < $length; $j++) {
                $this->assertEquals(Cell::DEAD, $universe->getCellState($i, $j));
            }
        }
    }

    public function testUniverseInizializeAliveCell()
    {
        $length = 4;
        $universe = new Universe($length);
        $universe->setCellAlive(1, 2);
        $this->assertEquals(Cell::ALIVE, $universe->getCellState(1, 2));
    }

    public function testCalculateAliveNeighbours(){
        $this->markTestSkipped();
        $length = 4;
        $universe = new Universe($length);
        $universe->setCellAlive(1, 0);
        $universe->setCellAlive(1, 1);
        $universe->setCellAlive(1, 2);
        $this->assertEquals(2,$universe->calculateAliveNeighbours(1,1));
    
    
    }

    public function testCalculateNextUniverseState()
    {
        $length = 4;
        $universe = new Universe($length);
        $universe->setCellAlive(0, 1);
        $universe->setCellAlive(1, 1);
        $universe->setCellAlive(2, 1);
        $universe->calculateNextState();
        //$universe->evolve();
        $this->assertEquals(Cell::DEAD, $universe->getCellState(0, 0));
        $this->assertEquals(Cell::DEAD, $universe->getCellState(0, 1));
        $this->assertEquals(Cell::DEAD, $universe->getCellState(0, 2));
        $this->assertEquals(Cell::ALIVE, $universe->getCellState(1, 0));
        $this->assertEquals(Cell::ALIVE, $universe->getCellState(1, 1));
        $this->assertEquals(Cell::ALIVE, $universe->getCellState(1, 2));
        $this->assertEquals(Cell::DEAD, $universe->getCellState(2, 0));
        $this->assertEquals(Cell::DEAD, $universe->getCellState(2, 1));
        $this->assertEquals(Cell::DEAD, $universe->getCellState(2, 2));
    }
}
