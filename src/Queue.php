<?php

namespace HenriqueBS0\DataStructures;

class Queue {
    private Nodo|null $start = null;
    private Nodo|null $end   = null;

    private function getStart() : Nodo|null 
    {
        return $this->start;
    }

    private function setStart(Nodo|null $start) : self
    {
        $this->start = $start;

        return $this;
    }

    private function getEnd() : Nodo|null
    {
        return $this->end;
    }

    private function setEnd(Nodo|null $end) : self
    {
        $this->end = $end;

        return $this;
    }

    public function insert(mixed $dado) : self
    {
        $nodo = new Nodo($dado);

        if($this->isEmpty()) {
            $this->setStart($nodo);
        }
        else {
            $this->getEnd()->setNext($nodo);
        }

        $this->setEnd($nodo);

        return $this;
    }

    public function remove() : mixed 
    {
        if($this->isEmpty()) {
            return null;
        }

        $nodo = $this->getStart();

        if(is_null($this->getStart()->getNext()))  {
            $this->setStart(null);
            $this->setEnd(null);
        }

        $this->setStart($nodo->getNext());

        return $nodo->getContent();
    }
 
    public function isEmpty() : bool {
        return is_null($this->getStart());
    }
}