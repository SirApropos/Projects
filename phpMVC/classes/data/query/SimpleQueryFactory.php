<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:40 PM
 */

class SimpleQueryFactory implements QueryFactory {
    /**
     * @var DataSource
     */
    private $datasource;

    /**
     * @var SimpleQueryFactory
     */
    private static $instance;

    function __construct(DataSource $datasource)
    {
        $this->datasource = $datasource;
    }


    /**
     * @return Query
     */
    public function createQuery(){
        return new CriteriaQuery($this->datasource);
    }

    /**
     * @return SimpleQueryFactory
     */
    public static function getInstance(){
        return self::instance;
    }
}