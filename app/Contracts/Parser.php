<?php

namespace App\Contracts;

interface Parser
{
    public function setLink(string $link) : self;

    public function parse() : array;
}
