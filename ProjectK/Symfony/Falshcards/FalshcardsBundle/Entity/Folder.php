<?php

namespace Falshcards\FalshcardsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Falshcards\FalshcardsBundle\Entity\Folder
 */
class Folder
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var integer $idfolder
     */
    private $idfolder;


    /**
     * Set name
     *
     * @param string $name
     * @return Folder
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get idfolder
     *
     * @return integer 
     */
    public function getIdfolder()
    {
        return $this->idfolder;
    }
}
