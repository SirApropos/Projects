<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:39 PM
 */

class CriteriaQuery implements Query{
    private static $SELECT = 1;
    private static $FROM = 2;
    private static $JOIN = 3;
    private static $NOT = 4;
    private static $ALSO = 5;
    private static $EQUALS = 6;
    private static $LIKE = 7;
    private static $WHERE = 8;
    private static $ORDERBY = 9;
    private static $NOTEQUALS = 10;
    private static $NOTLIKE = 11;
    private static $COUNT = 12;

    private $actions = [];

    /**
     * @var DataSource
     */
    private $datasource;

    /**
     * @param $datasource
     */
    function __construct(DataSource $datasource)
    {
        $this->datasource = $datasource;
    }

    /**
     *
     */
    public function execute()
    {
        // TODO: Implement execute() method.
    }

    /**
     * @param $str
     * @return $this
     */
    public function select($str){
        $this->addPart($str, self::$SELECT);
        return $this;
    }

    /**
     * @param $table
     * @return $this
     */
    public function from($table){
        $this->addPart($table, self::$FROM);
        return $this;
    }

    /**
     * @param $var
     * @return $this
     */
    public function also($var){
        $this->addPart($var, self::$ALSO);
        return $this;
    }

    /**
     * @param $obj
     * @return $this
     */
    public function where($obj){
        $this->addPart($obj, self::$WHERE);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function equals($value){
        $this->addPart($value, self::$EQUALS);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function like($value){
        $this->addPart($value, self::$LIKE);
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function orderBy($column){
        $this->addPart($column, self::$ORDERBY);
        return $this;
    }

    /**
     * @param $table
     * @return $this
     */
    public function join($table){
        $this->addPart($table, self::$JOIN);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function notEquals($value){
        $this->addPart($value, self::$NOTEQUALS);
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function notLike($value){
        $this->addPart($value, self::$NOTLIKE);
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function count($field){
        $this->addPart($field, self::$COUNT);
        return $this;
    }

    private function addPart($obj, $action){
        $actions[]  = ["value" => $obj, "action" => $action];
    }

    public function getParts()
    {
        return $this->actions;
    }


}