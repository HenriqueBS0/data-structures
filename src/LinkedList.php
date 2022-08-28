<?php

namespace HenriqueBS0\DataStructures;

class LinkedList {
    
    private Nodo|null $start = null;
    private Nodo|null $end = null;
     
    public function getStart() : Nodo|null
    {
        return $this->start;
    }

    private function setStart(Nodo|null $start) : self
    {
        $this->start = $start;

        return $this;
    }

        /**
     * Get the value of end
     */ 
    public function getEnd() : Nodo|null
    {
        return $this->end;
    }

    public function setEnd(Nodo|null $end) : self
    {
        $this->end = $end;

        return $this;
    }

    public function insertStart(mixed $dado) : self
    {
        $nodo = new Nodo($dado);

        if($this->isEmpty()) {
            $this->setStart($nodo);
            $this->setEnd($nodo);
            return $this;
        }

        if($this->length() === 1) {
            $nodo->setNext($this->getEnd());
            $this->getEnd()->setPrevious($nodo);
            $this->setStart($nodo);
            return $this;
        }

        $nodo->setNext($this->getStart());
        $this->getStart()->setPrevious($nodo);
        $this->setStart($nodo);
        
        return $this;
    }
    
    public function removeStart() : self
    {
        if($this->isEmpty()) {
            return $this;
        }

        if($this->length() === 1) {
            $this->setStart(null);
            $this->setEnd(null);
            return $this;
        }

        $newStartNodo = $this->getStart()->getNext();
        $newStartNodo->setPrevious(null);
        $this->setStart($newStartNodo);

        return $this;
    }

    public function insertEnd(mixed $dado) : self
    {
        $nodo = new Nodo($dado);

        if($this->isEmpty()) {
            $this->setStart($nodo);
            $this->setEnd($nodo);
            return $this;
        }

        if($this->length() === 1) {
            $nodo->setPrevious($this->getStart());
            $this->getStart()->setNext($nodo);
            $this->setEnd($nodo);
            return $this;
        }

        $nodo->setPrevious($this->getEnd());
        $this->getEnd()->setNext($nodo);
        $this->setEnd($nodo);
        
        return $this;
    }

    public function removeEnd() : self
    {
        if($this->isEmpty()) {
            return $this;
        }

        if($this->length() === 1) {
            $this->setStart(null);
            $this->setEnd(null);
            return $this;
        }

        $newEndNodo = $this->getEnd()->getPrevious();
        $newEndNodo->setNext(null);
        $this->setEnd($newEndNodo);

        return $this;
    }

    public function getPosition(mixed $comparation) : int 
    {
        $position = 0;

        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $position++;

            if(self::passedOn($comparation, [$nodo->getContent()])) {
                break;
            }

            $nodo = $nodo->getNext();
        }

        return $position;
    }

    public function getAllPosition(mixed $comparation) : array
    {
        $position = 0;
        $positions = [];

        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $position++;

            if(self::passedOn($comparation, [$nodo->getContent()])) {
                $positions[] = $position;
            }

            $nodo = $nodo->getNext();
        }

        return $positions;
    }

    public function get(mixed $comparation) : mixed
    {
        $position = 0;

        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $position++;

            if(self::passedOn($comparation, [$nodo->getContent(), $position])) {
                return $nodo->getContent();
            }

            $nodo = $nodo->getNext();
        }

        return null;
    }

    public function getAll(mixed $comparation) : array 
    {
        $values = [];

        $position = 0;

        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $position++;

            if(self::passedOn($comparation, [$nodo->getContent(), $position])) {
                $values[] = $nodo->getContent();
            }

            $nodo = $nodo->getNext();
        }

        return $values;
    }

    public function remove(mixed $comparation) : self
    {
        $position = 0;

        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $position++;

            if(self::passedOn($comparation, [$nodo->getContent(), $position])) {
                $this->removeNodo($nodo);
                break;
            }

            $nodo = $nodo->getNext();
        }

        return $this;
    } 

    public function removeAll(mixed $comparation) : self
    {
        $position = 0;

        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $position++;

            if(self::passedOn($comparation, [$nodo->getContent(), $position])) {
                $this->removeNodo($nodo);
            }

            $nodo = $nodo->getNext();
        }

        return $this;
    }

    private function removeNodo(Nodo $nodo) : self 
    {
        if($nodo === $this->getStart()) {
            return $this->removeStart();
        }

        if($nodo === $this->getEnd()) {
            return $this->removeEnd();
        }

        $nodo->getPrevious()->setNext($nodo->getNext());
        $nodo->getNext()->setPrevious($nodo->getPrevious());

        return $this; 
    }

    private static function passedOn(mixed $comparation, array $parameters) : bool
    {

        if(!is_callable($comparation)) {
            return $comparation === $parameters[0];
        }

        return call_user_func_array($comparation, $parameters);
    }

    public function length() : int 
    {
        $length = 0;
        $nodo = $this->getStart();

        while(!is_null($nodo)) {
            $length++;
            $nodo = $nodo->getNext();
        }

        return $length;
    }

    public function isEmpty() : bool {
        return is_null($this->getStart());
    }
}