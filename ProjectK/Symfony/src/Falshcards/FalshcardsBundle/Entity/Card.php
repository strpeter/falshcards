<?php

namespace Falshcards\FalshcardsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Falshcards\FalshcardsBundle\Entity\Card
 */
class Card
{
    /**
     * @var string $question
     */
    private $question;

    /**
     * @var string $answer
     */
    private $answer;

    /**
     * @var integer $idcard
     */
    private $idcard;

    /**
     * @var Falshcards\FalshcardsBundle\Entity\Folder
     */
    private $ffolder;


    /**
     * Set question
     *
     * @param string $question
     * @return Card
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Card
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Get idcard
     *
     * @return integer 
     */
    public function getIdcard()
    {
        return $this->idcard;
    }

    /**
     * Set ffolder
     *
     * @param Falshcards\FalshcardsBundle\Entity\Folder $ffolder
     * @return Card
     */
    public function setFfolder(\Falshcards\FalshcardsBundle\Entity\Folder $ffolder = null)
    {
        $this->ffolder = $ffolder;
    
        return $this;
    }

    /**
     * Get ffolder
     *
     * @return Falshcards\FalshcardsBundle\Entity\Folder 
     */
    public function getFfolder()
    {
        return $this->ffolder;
    }
}
