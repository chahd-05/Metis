<?php

require_once 'Project.php';

class ShortProject extends Project
{
    public function getType(): string
    {
        return "ShortProject";
    }
}
