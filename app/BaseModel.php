<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class BaseModel extends Model
{
    /**
     * Returns the model singular table name.
     *
     * @return string
     */
    public function getSingularTableName()
    {
        return str_singular($this->getTableName());
    }

    /**
     * Returns model table name.
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->getTable();
    }

    /**
     * Returns the model name.
     *
     * @return string
     */
    public function getModelName()
    {
        $reflect = new ReflectionClass($this);
        return $reflect->getShortName();
    }

    /**
     * Returns the controller name.
     *
     * @return string
     */
    public function getControllerName()
    {
        return $this->getModelName() . "Controller";
    }
}
