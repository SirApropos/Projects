<?php
/**
 * Created by Apropos (sir.apropos.of.nothing@gmail.com).
 * Date: 7/12/13
 * Time: 11:47 PM
 */
class HttpRequest
{
    private $method;

    private $path;

    /**
     * @var HttpHeaders
     */
    private $headers;

    public function HttpRequest($server){
        $this->method = constant("RequestMethod::".$server['REQUEST_METHOD']);
        $this->path = $this->buildPath($_SERVER['REQUEST_URI']);
        $this->headers = new HttpHeaders();
        if(isset($server['CONTENT_TYPE'])){
            $this->headers->setContentType($_SERVER['CONTENT_TYPE']);
        }else{
            $this->headers->setContentType("text/plain");
        }
    }

    private function buildPath($path){
        $path = str_replace("`","",$path);
        $path = preg_replace("`^(.+?)\?.*`","$1",$path);
        $path = preg_replace("`^".Config::$BASE_PATH."(.*)`","$1",$path);
        return $path;
    }

    /**
     * @param RequestMethod $method
     */
    public function setMethod(RequestMethod $method)
    {
        $this->method = $method;
    }

    /**
     * @return RequestMethod
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return HttpHeaders
     */
    public function getHeaders(){
        return $this->head;
    }
}