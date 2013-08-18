<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/18/13
 * Time: 10:37 PM
 */

class DelegatingMatcher implements Matcher{
    /**
     * @var
     */
    private $actual;

    /**
     * @var callable
     */
    private $delegate;

    /**
     * @param $actual
     * @param callable $delegate
     */
    function __construct($actual, callable $delegate)
    {
        $this->expected = $actual;
        $this->delegate = $delegate;
    }

    /**
     * @param $expected
     * @return bool
     */
    public function match($expected)
    {
        return $this->delegate($expected, $this->actual);
    }

}