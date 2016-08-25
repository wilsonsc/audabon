@extends('layouts.master')

@section('title', 'View Bird Sightings')

@section('body')

        <?php
        foreach ($sightings as $sighting): ?>
        <details>
            <summary>
                <h2> <?php echo($sighting->getBird()->getSpecies()); ?> </h2>
            </summary>
            <ul>
                <b>Date: </b> <?php echo($sighting->getDate()->format('m-d-Y h:i A')); ?> <br>
                <b>Location: </b> <?php echo($sighting->getLocation()); ?> <br>
                <b>Description: </b> <?php echo($sighting->getDescription()); ?> <br>
            </ul>
        </details>
        <?php endforeach?>
@endsection