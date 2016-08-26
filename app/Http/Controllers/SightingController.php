<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use Audabon\Entities\Sighting;
use Audabon\Entities\Bird;
use Audabon\Entities\SightingRepository;
use App\Http\Requests;

class SightingController extends Controller
{

    public function create() {
        return view("sightings/create");
    }

    public function index(Request $request, EntityManager $em) {

        return view("sightings/index", ["sightings" => $this->getSightings($request, $em)]);

    }

    public function save(Request $request, EntityManager $em) {
        $sighting = new Sighting;

        //Check to see if bird species exists in database
        $bird = $em->getRepository(Bird::class)->findOneBy(array('species' => $request->input("species")));

        //Define setters to set object data
        $setters = array("name" => "setName", "email" => "setEmail", "phoneNum" => "setPhoneNum",
            "date" => "setDate", "location" => "setLocation", "description" => "setDescription");

        //Set each parameter of the object to the users input
        foreach ($setters as $key => $value) {
            $sighting->$value($request->input($key));
        }

        //If the bird species does not exist in database, create it
        if (empty($bird)) {
            $bird = new Bird;
            $bird->setSpecies($request->input("species"));
        }

        $sighting->setBird($bird);

        //Save the object to the database
        $em->persist($sighting);
        $em->flush();
        return redirect('sightings');
    }

    private function getSightings(Request $request, EntityManager $em) {
        $searchParams = $request->input('search');

        //If no search parameters were provided, create an empty array for query
        if ($searchParams == null) {
            $searchParams = array();

        }

        //If any search params were left blank by user remove that key/value from array
        foreach ($searchParams as $key => $value) {
            if ($value == null) {
                unset($searchParams[$key]);
            }
        }

        //Query database with user params
        return $em->getRepository(Sighting::class)->getBirds($searchParams);
    }
}
