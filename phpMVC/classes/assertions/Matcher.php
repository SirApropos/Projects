<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:34 PM
 */

interface Matcher {
    /**
     * @param $obj
     * @return bool
     */
    public function match($obj);
}