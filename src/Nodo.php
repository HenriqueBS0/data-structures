<?php

namespace HenriqueBS0\DataStructures;

class Nodo {
    private mixed $content;
    private Nodo|null $next     = null;
    private Nodo|null $previous = null;


    
    public function __construct(mixed $content)
    {
        $this->setContent($content);
    }

    /**
     * Get the value of content
     */ 
    public function getContent() : mixed
    {
        return $this->content;
    }

    /**
     * Set the value of content
     *
     * @return  self
     */ 
    public function setContent($content) : self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get the value of next
     */ 
    public function getNext() : Nodo | null
    {
        return $this->next;
    }

    /**
     * Set the value of next
     *
     * @return  self
     */ 
    public function setNext($next) : self
    {
        $this->next = $next;

        return $this;
    }

    /**
     * Get the value of previous
     */ 
    public function getPrevious() : Nodo | null
    {
        return $this->previous;
    }

    /**
     * Set the value of previous
     *
     * @return  self
     */ 
    public function setPrevious($previous) : self
    {
        $this->previous = $previous;

        return $this;
    }
}
