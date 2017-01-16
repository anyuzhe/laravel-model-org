<?php

namespace App\ZL\Traites;

trait ModelOptions
{
    //$options_number=0 $options_arry = []

    public $options_number = 0;

    public function appendOption($target)
    {
        $this->options_number |= pow(2,$target);
    }

    public function removeOption($target)
    {
        if($this->containOption($target)){
            $this->options_number = ($this->options_number-pow(2,$target));
        }
    }

    public function containOption($target)
    {
        return (($this->options_number | pow(2,$target)) == $this->options_number);
    }

    public function appendOptionByTitle($title)
    {
        $this->appendOption(array_search($title,$this->options_arry));
    }

    public function removeOptionByTitle($title)
    {
        $this->removeOption(array_search($title,$this->options_arry));
    }

    public function setOptionsByRequest()
    {
        foreach ($this->options_arry as $k=>$v) {
            $_has = isset($_REQUEST[$v])?$_REQUEST[$v]:false;
            if($_has){
                $this->appendOption($k);
            }
        }
    }
    
    public function setOptionsAttribute($value)
    {
        $this->setOptionsByRequest();
        return $this->options_number;
    }

    public function getOptionsAttribute($value)
    {
        return $this->getOptionsArray($value);
    }

    protected function getOptionsArray($value)
    {
        $this->options_number = $value;
        foreach ($this->options_arry as $k=>$v) {
            if($this->containOption($k)){
                $_value = 1;
            }else{
                $_value = 0;
            }
            $res[$v] = $_value;
        }
        return $res;
    }
}