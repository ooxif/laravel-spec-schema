<?php

namespace Ooxif\LaravelSpecSchema;

use Illuminate\Database\Schema\Grammars\Grammar;

trait BuilderTrait
{
    /**
     * @return Grammar
     */
    public function getGrammar()
    {
        return $this->grammar;
    }

    /**
     * @param Grammar $grammar
     */
    public function setGrammar(Grammar $grammar)
    {
        $this->grammar = $grammar;
    }
}