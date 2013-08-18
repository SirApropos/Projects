<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:33 PM
 */

trait CoreMatchers {
    public static function equalTo($obj){
        return new DelegatingMatcher($obj, function($expected, $actual){

        });
    }
}