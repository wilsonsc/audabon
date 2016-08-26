<?php

use Audabon\Entities\Sighting;
use Audabon\Entities\Bird;
use Peridot\Leo\Interfaces\Assert;

describe("Bird", function() {

    beforeEach(function () {
        $this->assert = new Assert();
        $this->bird = new Bird();
    });

    describe("->getLocations()", function () {

        $createLocationMock = function ($setLocation) {
            $sighting = $this->getProphet()->prophesize(Sighting::class);
            $sighting->getLocation()->willReturn($setLocation);
            $sighting = $sighting->reveal();
            return $sighting;
        };

        it("should return an empty array when no sightings exist", function () {
            $this->assert->equal($this->bird->getLocations(), array());
        });

        it("should return an array with a single location and key val 1", function () use ($createLocationMock) {
            $sighting = $createLocationMock("here");
            $this->bird->setSighting(array($sighting));
            $this->assert->equal($this->bird->getLocations(), array("here" => 1));
        });

        it("should return an array with a single location and key val 5", function () use ($createLocationMock) {
            for ($i = 0; $i < 5; $i++) {
                $sightings[$i] = $createLocationMock("here");
            }
            $this->bird->setSighting($sightings);
            $this->assert->equal($this->bird->getLocations(), array("here" => 5));
        });

        it("should return an array with multiple locations and key val 1", function () use ($createLocationMock) {
            $locations = array("here", "there", "everywhere");
            foreach ($locations as $location) {
                $sightings[] = $createLocationMock($location);
            }
            $this->bird->setSighting($sightings);
            $this->assert->equal($this->bird->getLocations(), array("here" => 1, "there" => 1,
                "everywhere" => 1));
        });

    });


    describe("->getPopularSeason()", function () {

        $createSeasonMock = function ($month) {
            $sighting = $this->getProphet()->prophesize(Sighting::class);
            $sighting->getDate()->willReturn($month);
            $sighting = $sighting->reveal();
            return $sighting;
        };

        $seasons = array("Winter" => new DateTime('2000-' . random_int(1, 3) . '-01'),
            "Spring" => new DateTime('2000-' . random_int(4, 6) . '-01'),
            "Summer" => new DateTime('2000-' . random_int(7, 9) . '-01'),
            "Fall" => new DateTime('2000-' . random_int(10, 12) . '-01'));

        it("should return 'No sightings have been recorded'", function () {
            $this->assert->equal($this->bird->getPopularSeason(), "No sightings have been recorded");
        });

        it("should return with 1/1 sightings in Winter", function () use ($createSeasonMock, $seasons) {
            $sightings[] = $createSeasonMock($seasons["Winter"]);
            $this->bird->setSighting($sightings);
            $this->assert->equal($this->bird->getPopularSeason(), "Winter 1/1 (100%)");
        });

        it("should return with 2/3 sightings in Summer", function () use ($createSeasonMock, $seasons) {
            $months = array($seasons["Winter"], $seasons["Summer"], $seasons["Summer"]);
            foreach ($months as $month) {
                $sightings[] = $createSeasonMock($month);
            }
            $this->bird->setSighting($sightings);
            $this->assert->equal($this->bird->getPopularSeason(), "Summer 2/3 (" . 2 / 3 * 100 . "%)");
        });

        it("should return with equal sightings in Winter and Summer", function () use ($createSeasonMock, $seasons) {
            $months = array($seasons["Winter"], $seasons["Winter"], $seasons["Summer"],
                $seasons["Summer"], $seasons["Fall"], $seasons["Spring"]);
            foreach ($months as $month) {
                $sightings[] = $createSeasonMock($month);
            }
            $this->bird->setSighting($sightings);
            $this->assert->equal($this->bird->getPopularSeason(),
                "Winter and Summer equally sighted 2/6 (" . 2 / 6 * 100 . "%)");
        });

        it("should return with a single sighting in each season", function () use ($createSeasonMock, $seasons) {
            $months = array($seasons["Winter"], $seasons["Spring"], $seasons["Summer"], $seasons["Fall"]);
            foreach ($months as $month) {
                $sightings[] = $createSeasonMock($month);
            }
            $this->bird->setSighting($sightings);
            $this->assert->equal($this->bird->getPopularSeason(),
                "Winter, Spring, Summer and Fall equally sighted 1/4 (25%)");
        });
    });

    describe("->addSighting()", function () {
        it("should allow sightings to be added and appended", function () {
            $sightings[0] = $this->getProphet()->prophesize(Sighting::class);
            $sightings[0] = $sightings[0]->reveal();
            $this->bird->addSighting($sightings[0]);
            $this->assert->equal($this->bird->getSighting(), $sightings);
            for ($i = 1; $i < 5; $i++) {
                $sightings[$i] = $this->getProphet()->prophesize(Sighting::class);
                $sightings[$i] = $sightings[$i]->reveal();
                $this->bird->addSighting($sightings[$i]);
            }
            $this->assert->equal($this->bird->getSighting(), $sightings);
        });
    });

});