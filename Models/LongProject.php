<?php

require_once 'Project.php';

class LongProject extends Project
{
    public function getType(): string
    {
        return "LongProject";
    }
}
