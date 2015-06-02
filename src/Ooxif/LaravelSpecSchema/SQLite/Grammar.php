<?php

namespace Ooxif\LaravelSpecSchema\SQLite;

use Illuminate\Database\Schema\Grammars\SQLiteGrammar as BaseGrammar;
use Ooxif\LaravelSpecSchema\GrammarTrait;

class Grammar extends BaseGrammar
{
    use GrammarTrait;
}