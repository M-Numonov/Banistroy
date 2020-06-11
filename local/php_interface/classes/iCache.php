<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 26.07.2019
 * Time: 12:23
 */

class iCache{
    private $cache_id;
    private $cache_time;
    private $cache_path;
    public $cache;
    function __construct($cache_id, $cache_time=36000, $cache_path="/iCache/")
    {
        if(!$cache_id) return false;
        $this->cache_id=$cache_id;
        $this->cache_time=$cache_time;
        $this->cache_path=$cache_path;
        $this->cache=new CPHPCache();
        return $this;
    }
    function hasCache(){
        if ($this->cache->InitCache($this->cache_time, $this->cache_id, $this->cache_path) && $_REQUEST["clear_cache"]!="Y") {
            return   $this->cache->GetVars();
        }
        return false;

    }
    function SaveToCache($var){
        $this->cache->StartDataCache($this->cache_time, $this->cache_id, $this->cache_path);
        $this->cache->EndDataCache($var);
    }
}