<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/13/13
 * Time: 11:22 PM
 */

class XmlMapper implements Mapper {

    /**
     * @param string $contentType
     * @return bool
     */
    public function canRead($contentType)
    {
        // TODO: Implement canRead() method.
    }

    /**
     * @param string $contentType
     * @return bool
     */
    public function canWrite($contentType)
    {
        // TODO: Implement canWrite() method.
    }

    /**
     * @param object $obj
     * @return string
     */
    public function write($obj)
    {
        // TODO: Implement write() method.
    }

    /**
     * @param $str
     * @param ReflectionClass $clazz
     * @return mixed
     */
    public function read($str, ReflectionClass $clazz)
    {
        // TODO: Implement read() method.
    }
}