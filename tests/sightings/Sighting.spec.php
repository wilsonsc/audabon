<?php

use Audabon\Entities\Sighting;
use Peridot\Leo\Interfaces\Assert;

describe("Sighting", function() {

    beforeEach(function(){
        $this->assert = new Assert();
        $this->sighting = new Sighting();
    });
    describe("->setDate()", function(){

        it("should cast parameter to DateTime", function(){
            $this->sighting->setDate('2016-08-17T04:34');
            $this->assert->instanceOf($this->sighting->getDate(), 'DateTime');
        });

        it("should accept alternate DateTime formatting as input", function(){
            $this->sighting->setDate("2008W273");
            $this->assert->instanceOf($this->sighting->getDate(), 'DateTime');
            $this->sighting->setDate("20080701T22:38:07");
            $this->assert->instanceOf($this->sighting->getDate(), 'DateTime');
            $this->sighting->setDate("2008.197");
            $this->assert->instanceOf($this->sighting->getDate(), 'DateTime');
        });

       it("should throw an exception on invalid input", function() {
           $this->assert->throws(function() {$this->sighting->setDate("this is an invalid date");},
               'Exception');
        });
    });
});