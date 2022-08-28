<?php

namespace HenriqueBS0\DataStructures;

class Stack {
    private Nodo|null $top = null;

    public function push(mixed $dado) : self 
    {
        $nodo = new Nodo($dado);

        if(!$this->isEmpty()) {
            $nodo->setPrevious($this->top);
            $this->top->setNext($nodo);
        }

        $this->top = $nodo;

        return $this;
    }

    public function pop() : mixed
    {
        if($this->isEmpty()) {
            return null;
        }
        
        $removedNodo = $this->top;

        if(is_null($removedNodo->getPrevious())) {
            $this->top = null;
        }
        else {
            $this->top = $removedNodo->getPrevious();
            $this->top->setNext(null);
        }

        return $removedNodo->getContent();
    }

    public function top() : mixed
    {
        if($this->isEmpty()) {
            return null;
        }

        return $this->top->getContent();
    }

    public function isEmpty() : bool 
    {
        return is_null($this->top);
    }
}