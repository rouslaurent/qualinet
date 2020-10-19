<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class PersonSearch {
    /**
     * @var string|null
     */
    private $personName;

    /**
     * @var ArrayCollection
     */
	private $localisations;

    public function __construct()
    {
        $this->localisations = new ArrayCollection();
    }
    /**
     * Get the value of personName
     *
     * @return  string|null
     */ 
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * Set the value of personName
     *
     * @param  string|null  $personName
     *
     * @return  self
     */ 
    public function setPersonName($personName)
    {
        $this->personName = $personName;

        return $this;
    }

	/**
	 * Get the value of localisations
	 *
	 * @return  ArrayCollection
	 */ 
	public function getLocalisations()
	{
		return $this->localisations;
	}

	/**
	 * Set the value of localisations
	 *
	 * @param  ArrayCollection  $localisations
	 *
	 * @return  self
	 */ 
	public function setLocalisations(ArrayCollection $localisations)
	{
		$this->localisations = $localisations;

		return $this;
	}
}