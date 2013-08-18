<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:32 PM
 */

interface Query {
    public function execute();

    public function getParts();

    /**
     * @param $str
     * @return $this
     */
    public function select($str);

    /**
     * @param $table
     * @return $this
     */
    public function from($table);

    /**
     * @param $var
     * @return $this
     */
    public function also($var);

    /**
     * @param $obj
     * @return $this
     */
    public function where($obj);

    /**
     * @param $value
     * @return $this
     */
    public function equals($value);

    /**
     * @param $value
     * @return $this
     */
    public function like($value);

    /**
     * @param $column
     * @return $this
     */
    public function orderBy($column);
    /**
     * @param $table
     * @return $this
     */
    public function join($table);

    /**
     * @param $value
     * @return $this
     */
    public function notEquals($value);

    /**
     * @param $value
     * @return $this
     */
    public function notLike($value);

    /**
     * @param $field
     * @return $this
     */
    public function count($field);

}