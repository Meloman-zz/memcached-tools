<?php

class MemcachedTools extends Memcached {
    
    private $verbose;
    
    
    public function __construct($persistent_id, $verbose = false) {
        
        $this->verbose = $verbose;
        
        return parent::__construct($persistent_id);
    }
    
    
    public function del($mask, $time = 0) {
        
        if($mask == '')
            return false;
        
        $keyword = trim($mask, '*');
        
        foreach(parent::getAllKeys() as $key) {
            
            // wildcard
            if(substr($mask, 0, 1) == '*' 
            && substr($mask, -1) == '*' 
            && strpos($key, $keyword) !== false) {
                parent::delete($key, $time);
                if($this->verbose) echo "$key supprimée\n";
            }
            
            // starts with
            elseif(substr($mask, -1) == '*' 
            && substr($key, 0, strlen($keyword)) === $keyword) {
                parent::delete($key, $time);
                if($this->verbose) echo "$key supprimée\n";
            }
            
            // ends with
            elseif(substr($mask, 0, 1) == '*' 
            && substr($key, -(strlen($keyword))) === $keyword) {
                parent::delete($key, $time);
                if($this->verbose) echo "$key supprimée\n";
            }
            
            // exact phrase
            elseif($key == $keyword) {
                parent::delete($key, $time);
                if($this->verbose) echo "$key supprimée\n";
            }
            
        }
        
    }
    
    
    public function getNestedKeys($delimiter = '.', $nested = array()) {
        
        foreach (parent::getAllKeys() as $path) {
            $lastItem = array('key' => $path);
            foreach (array_reverse(explode($delimiter, $path)) as $key) {
                $lastItem = array($key => $lastItem);
            }
            $nested = array_merge_recursive($nested, $lastItem);
        }
        
        if($this->verbose) print_r($nested);
        
        return $nested;
    }
    
    
}
