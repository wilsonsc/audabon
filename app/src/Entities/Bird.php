<?php

namespace Audabon\Entities;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/** @ORM\Entity */

class Bird {

    /**
     * @ORM\OneToMany(targetEntity="Sighting", mappedBy="bird")
     */
    private $sighting;

    public function __construct() {
        $this->features = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /** @ORM\Column(type="string") */
    private $species;

    public function getLocations() {
        //An array of all the locations this bird has a reported sighting
        $locationsFound = array();

        foreach ($this->sighting as $sighting) {
            //If there is not a location associated with this sighting, create one with 1 sighting
            if (!array_key_exists($sighting->getLocation(), $locationsFound)) {
                $locationsFound[$sighting->getLocation()] = 1;
            }
            else {
                //Increment the number of sightings at the reported location
                $locationsFound[$sighting->getLocation()]++;
            }
        }
        return $locationsFound;
    }

    /**
     * @return mixed|string the most popular season of sightings for this bird
     * in format of - season #/max# (#%)
     */
    public function getPopularSeason() {

        //Each array indice corresponds to counts for a quarter of the year
        //eg. 0-2 1st quarter, 3-5 2nd quarter.
        $seasons = array(0, 0, 0, 0);

        //Increment each quarter of the $seasons array based upon the season sighted in
        foreach ($this->sighting as $sighting) {
            $seasons[intval($sighting->getDate()->format('m') - 1) / 3]++;
        }

        return $this->formatSeasonOutput($seasons);
    }

    /**
     * @param $numSightingsPerSeason an array corresponding to the number of times sighted in each season
     * @return mixed|string a string in the format of - season #/max# (#%)
     */
    private function formatSeasonOutput($numSightingsPerSeason) {
        //Create an array of the indice of the most frequently occuring season
        $mostFrequent = array_keys($numSightingsPerSeason, max($numSightingsPerSeason));

        //Corresponding English translations of each quarter of the year
        $namesOfSeasons = array("Winter", "Spring", "Summer", "Fall");

        //Format the return string
        if (sizeOf($mostFrequent) == 1) {
            return $namesOfSeasons[$mostFrequent[0]] . " " . $numSightingsPerSeason[$mostFrequent[0]] . "/" .
            array_sum($numSightingsPerSeason) . " (" .
            ($numSightingsPerSeason[$mostFrequent[0]] / array_sum($numSightingsPerSeason) * 100) . "%)" ;
        }
        else {
            $frequentSeasons = $namesOfSeasons[$mostFrequent[0]];
            for ($i = 1; $i < (sizeOf($mostFrequent)); $i++) {
                $frequentSeasons .= " and " . $namesOfSeasons[$mostFrequent[$i]];
            }
            $frequentSeasons .= " equally sighted " . $numSightingsPerSeason[$mostFrequent[0]] . "/" .
                array_sum($numSightingsPerSeason) . " (" . ($numSightingsPerSeason[$mostFrequent[0]]
                    / array_sum($numSightingsPerSeason) * 100) . "%)" ;

            return $frequentSeasons;
        }
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSighting()
    {
        return $this->sighting;
    }

    /**
     * @param mixed $sighting
     */
    public function setSighting($sighting)
    {
        $this->sighting = $sighting;
    }

    /**
     * @return mixed
     */
    public function getSpecies()
    {
        return $this->species;
    }

    /**
     * @param mixed $species
     */
    public function setSpecies($species)
    {
        $this->species = $species;
    }


}