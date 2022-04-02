<?php

class Counter {

    const INCREMENT = 1;
    public $file;

    public function __construct(string $var1)
    {
        $this->file = $var1;
    }
    public function increment(): void
    {
        if (file_exists($this->file)) {
            $views = (int)file_get_contents($this->file);
            $views += static::INCREMENT;
        } else {
            $views = 1;
        }
        file_put_contents($this->file, $views);
    }
    public function get_views(): int
    {
        if (!file_exists($this->file)) {
            return 0;
        }
        return (int)file_get_contents($this->file);
    }

}