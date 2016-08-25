<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Audabon Society - @yield('title') </title>
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>

<div>
    <a href="sightings">Submit a Sighting</a>
    <a href="index">View All Sightings</a>
    <a href="birdIndex">View Bird Data</a> </p>

    <form action="/index" method="get">
        <fieldset>
            <legend>Search for existing sightings</legend>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <p> <label> by Species: </label> <input type="text" name="search[species]"> </p>
            <p> <label>by Location: </label> <input type="text" name="search[location]"> </p>
            <input type="submit">
        </fieldset>
    </form>
</div>
<br>

@yield('body')

</body>
</html>