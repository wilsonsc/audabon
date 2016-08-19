@extends('layouts.master')

@section('title', 'View Bird Sightings')

@section('body')

        <?php
        foreach ($sightings as $sighting): ?>
        <details>
            <summary>
                <b> <?php echo($sighting->getSpecies()); ?> </b>
            </summary>
            <ul>
                <p><b>Date: </b> <?php echo($sighting->getDate()->format('m-d-Y h:i A')); ?> </p>
                <p><b>Location: </b> <?php echo($sighting->getLocation()); ?> </p>
                <p><b>Description: </b> <?php echo($sighting->getDescription()); ?> </p>
            </ul>
        </details>
        <?php endforeach?>
@endsection