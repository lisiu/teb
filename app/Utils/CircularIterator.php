<?php

namespace App\Utils;

class CircularIterator extends \IteratorIterator
{
    public function next()
    {
        parent::next();

        if (!$this->valid()) {
            $this->rewind();
        }
    }
}
