<?php

namespace ZL\Traites;

trait ModelJson
{
    //$json_array = []

    public $options_number = 0;

    public function getJsonArry()
    {
        return $this->json_array;
    }

    public function getJsonByRequest()
    {
        foreach ($this->json_array as $k=>$v) {
            $req = $GLOBALS['request']->all();
            $_has = isset($req[$v])?$req[$v]:false;
            if($_has){
                $this->json_array_key_value[$v] = $req[$v];
            }
        }
        return $this->json_array_key_value;
    }
    
    public function setJsonAttribute($value)
    {
        $this->attributes['json'] = json_encode($this->getJsonByRequest(),JSON_UNESCAPED_UNICODE);
    }

    public function getJsonAttribute($value)
    {
        return json_decode($value,true);
    }

}