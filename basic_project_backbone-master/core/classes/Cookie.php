<?php

namespace Core;

class Cookie extends Abstracts\Cookie {
    public function __construct(string $name) {
        $this->name = $name;
    }

    public function delete(): void {
        
    }

    public function exists(): bool {
        if(isset($_COOKIE[$this->name])){
            return true;
        }else{
            return false;
        }
    }

    public function read(): array {
        
    }

    public function save($data, $expires_in = 3600): void {
        
    }

}
