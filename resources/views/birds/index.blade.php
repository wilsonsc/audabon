@extends('layouts.master')

@section('title', 'View Bird Statistics')

@section('body')

    <?php
    foreach ($birds as $bird): ?>
    <details>
        <summary>
            <h2> <?php echo($bird->getSpecies()); ?> </h2>
        </summary>
        <ul>
            <p> <b>Most Frequently Sighted Season: </b> <?php echo($bird->getPopularSeason()); ?> </p>
            <?php foreach ($bird->getLocations() as $key => $val): ?>
                <b>Location spotted: </b> <?php echo($key); ?> <br>
                <b>Times spotted: </b> <?php echo( $val);?> <br><br>
            <?php endforeach?>
        </ul>
    </details>
    <?php endforeach?>
@endsection