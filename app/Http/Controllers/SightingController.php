<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use Audabon\Entities\Sighting;
use App\Http\Requests;

class SightingController extends Controller
{
    //
    public function create() {
        return view("sightings/create");
    }

    public function index(Request $request, EntityManager $em) {

        return view("sightings/index", ["sightings" => $this->getSightings($request, $em)]);

    }

    public function save(Request $request, EntityManager $em) {
        $sighting = new Sighting;

        $setters = array("name" => "setName", "email" => "setEmail", "phoneNum" => "setPhoneNum",
            "date" => "setDate", "location" => "setLocation", "species" => "setSpecies",
            "description" => "setDescription");

        foreach ($setters as $key => $value) {
            $sighting->$value($request->input($key));
        }

        $em->persist($sighting);
        $em->flush();
        return redirect('sightings');
    }

    private function getSightings(Request $request, EntityManager $em) {
        return $em->getRepository('Audabon\Entities\Sighting')->findAll();
    }

}
