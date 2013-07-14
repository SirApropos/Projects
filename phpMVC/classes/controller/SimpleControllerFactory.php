<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/12/13
 * Time: 11:50 PM
 */
class SimpleControllerFactory implements ControllerFactory
{
    use ClassLoader;

    private $request;

    function getController(HttpRequest $request)
    {
        $this->request = $request;
        $method = $this->findController(Config::$BASE_DIR."controllers/");
        if(!$method){
            throw new HttpNotFoundException();
        }
        return $method;
    }

    private function findController($path){
        $dir = opendir($path);
        $result = null;
        while($file = readdir($dir)){
            if(!in_array($file, $this->list_ignore)){
                if(is_dir($file)){
                    $result = $this->findController($path.$file."/");
                }else{
                    $this->loadClass($file, $path);
                    $result = $this->getControllerMethod($this->getClassName($file));
                }
            }
            if($result){
                break;
            }
        }
        closedir($dir);
        return $result;
    }

    private function getControllerMethod($name){
        $clazz = new ReflectionClass($name);
        $mappings = ReflectionUtils::getMapping($name);
        $method = null;
        $pathFound = false;
        foreach($mappings as $mapping){
            $regex = str_replace("`","",$mapping['path']);
            $regex = preg_replace("#([\[\]\{\}\.\(\)\?\*])#","\\\\$1",$regex);
            $regex = str_replace("\\*\\*",".*",$regex);
            $regex = str_replace("\\*","[^/]*", $regex);
            $regex = "`^".$regex."$`";
            if(preg_match($regex, $this->request->getPath())){
                $pathFound = true;
                $allowed_methods = $mapping['allowed_methods'];
                if(is_array($allowed_methods)){
                    if(!in_array($this->request->getMethod(), $allowed_methods)){
                        continue;
                    }
                }
                $method = new ControllerMethod();
                $method->setController($clazz->newInstance());
                $method->setMethod($clazz->getMethod($mapping['method']['name']));
            }
        }
        if($pathFound && !$method){
            throw new HttpMethodNotAllowedException();
        }
        return $method;
    }

}
