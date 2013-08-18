<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:33 PM
 */

interface QueryFactory {
    /**
     * @return Query
     */
    public function createQuery();
}