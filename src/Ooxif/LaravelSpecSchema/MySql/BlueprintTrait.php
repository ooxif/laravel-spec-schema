<?php

namespace Ooxif\LaravelSpecSchema\MySql;

use Illuminate\Support\Fluent;

trait BlueprintTrait
{
    /**
     * MySQL's BINARY falls back to binary().
     * 
     * @param string $column
     * @param int $length
     * @return Fluent
     */
    public function myBinary($column, $length = 255)
    {
        return $this->addColumn('myBinary.binary', $column, compact('length'));
    }

    /**
     * MySQL's VARBINARY falls back to binary(). 
     * 
     * @param string $column
     * @param int $length
     * @return Fluent
     */
    public function myVarBinary($column, $length = 255)
    {
        return $this->addColumn('myVarBinary.binary', $column, compact('length'));
    }

    /**
     * MySQL's TINYBLOB falls back to binary().
     *
     * @param string $column
     * @return Fluent
     */
    public function myTinyBlob($column)
    {
        return $this->addColumn('myTinyBlob.binary', $column);
    }

    /**
     * MySQL's MEDIUMBLOB falls back to binary().
     *
     * @param string $column
     * @return Fluent
     */
    public function myMediumBlob($column)
    {
        return $this->addColumn('myMediumBlob.binary', $column);
    }

    /**
     * MySQL's LONGBLOB falls back to binary().
     *
     * @param string $column
     * @return Fluent
     */
    public function myLongBlob($column)
    {
        return $this->addColumn('myLongBlob.binary', $column);
    }

    /**
     * MySQL's TINYTEXT falls back to text().
     *
     * @param string $column
     * @return Fluent
     */
    public function myTinyText($column)
    {
        return $this->addColumn('myTinyText.text', $column);
    }
}