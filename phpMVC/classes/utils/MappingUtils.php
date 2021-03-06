<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/13/13
 * Time: 11:07 PM
 */

class MappingUtils {
    /**
     * @param array $arr
     * @param $clazz
     * @return mixed
     */
    public static function bindObject(array $arr, $clazz){
        if(!$clazz instanceof ReflectionClass){
            $clazz = new ReflectionClass($clazz);
        }
        $clazzName = $clazz->getName();
        $mapping = ReflectionUtils::getMapping($clazzName, "ModelMapping");
        /**
         * @var ModelMapping $mapping
         */
        $fields = $mapping->getMappings();
        $obj = IOCContainer::getInstance()->newInstance($clazz);
        foreach($arr as $key => $value){
            $val = null;
            if(isset($fields[$key])){
                if($fields[$key]->getIsArray()){
                    $val = [];
                    foreach($value as $vKey => $vValue){
                        $val[$vKey] = self::bindObject($vValue, $fields[$key]->getType());
                    }
                }else{
                    $val = self::bindObject($value, $fields[$key]->getType());
                }
            }else{
                $val = $value;
            }
            ReflectionUtils::setProperty($obj, $key, $val);
        }
        return $obj;
    }

    public static function getObjectVars($obj){
        $result = $obj;
        if(is_object($obj)){
            $result = [];
            $clazz = new ReflectionClass(get_class($obj));
            foreach($clazz->getProperties() as $property){
                $property->setAccessible(true);
                $result[$property->getName()] = self::getObjectVars($property->getValue($obj));
            }
        }
        return $result;
    }
}