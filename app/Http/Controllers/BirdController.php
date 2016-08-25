<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Doctrine\ORM\EntityManager;
use Audabon\Entities\Bird;
use App\Http\Requests;

class BirdController extends Controller
{
    public function index(Request $request, EntityManager $em) {
        return view("birds/index", ["birds" => $em->getRepository(Bird::class)->findAll()]);
    }
}
