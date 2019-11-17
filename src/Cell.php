<?php

declare(strict_types=1);

namespace GOF;

class Cell
{

    const ALIVE = 1;
    const DEAD = 0;

    private $state;
    private $nextState = null;

    public function __construct(int $state)
    {
        $this->state = $state === self::ALIVE ? self::ALIVE : self::DEAD;
    }


    public function setNextState(int $numberOfAliveNeighbours)
    {
        $this->nextState = $this->state;
        if ($this->state === self::ALIVE) {
            if ($numberOfAliveNeighbours < 2) {
                $this->nextState = self::DEAD;
            } elseif ($numberOfAliveNeighbours > 3) {
                $this->nextState = self::DEAD;
            }
        } elseif ($this->state === self::DEAD) {
            if ($numberOfAliveNeighbours === 3) {
                $this->nextState = self::ALIVE;
            }
        }
    }

    public function evolve()
    {
        $this->state = $this->nextState;
        $this->nextState = null;
    }

    public function getNextState()
    {
        return $this->nextState;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setAlive(){
        $this->state = self::ALIVE; 
    
    }
}
