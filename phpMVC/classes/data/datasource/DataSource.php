<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:32 PM
 */

interface DataSource {
    public function connect();

    /**
     * @param Query $query
     * @return mixed
     */
    public function executeQuery(Query $query);
}