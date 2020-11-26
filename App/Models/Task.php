<?php

namespace App\Models;

use DateTime;

class Task
{
    protected $id;
    protected $description;
    protected $due;
    protected $complete = false;

    public function setDescription($description)
    {
        $this->description = $description;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDue(DateTime $due)
    {
        $this->due = $due;
    }


    public function getDue()
    {
        if (!$this->due instanceof DateTime) {
            return new DateTime( $this->due );
        }
        return $this->due;
    }

    
    public function setComplete($complete = true)
    {
        $this->complete = $complete;
    }


    public function getComplete()
    {
        return  (bool) $this->complete;
    }


    public function getId()
    {
        return $this->id;
    }
}