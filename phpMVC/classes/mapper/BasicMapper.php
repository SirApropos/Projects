<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/13/13
 * Time: 11:22 PM
 */

class BasicMapper implements Mapper{
    private static $allowed_types = [ContentType::TEXT_HTML, ContentType::TEXT_PLAIN,
                                     ContentType::APPLICATION_X_WWW_FORM_URLENCODED, null, ""];
    /**
     * @param string $contentType
     * @return bool
     */
    public function canRead($contentType)
    {
        return $contentType == ContentType::TEXT_PLAIN;
    }

    /**
     * @param string $contentType
     * @return bool
     */
    public function canWrite($contentType)
    {
        return $this->canRead($contentType);
    }

    /**
     * @param object $obj
     * @return string
     */
    public function write($obj)
    {
        return http_build_query($obj);
    }

    /**
     * @param $str
     * @param ReflectionClass $clazz
     * @return mixed
     */
    public function read($str, ReflectionClass $clazz)
    {
        $vars = [];
		parse_str($str, $vars);
        return MappingUtils::bindObject($vars, $clazz);
    }


}