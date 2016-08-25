@extends('layouts.master')

@section('title', 'Submit Bird Sighting')

@section('body')

    <form name="submitSightingForm" action="/addsighting" onsubmit="return validateFormData()" method="post">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Submit a bird sighting:</legend>
            <p><label>Name: </label> <input type="text" name="name"> </p>
            <p><label>E-mail:</label> <input type="email" name="email"> </p>
            <p><label>Phone number: </label> <input type="tel" name="phoneNum"> </p>
            <p><label>Date: </label> <input type="datetime-local" name="date" required> </p>
            <p><label>Location: </label> <input type="text" name="location" required> </p>
            <p><label>Species: </label> <input type="text" name="species" required> </p>
            <p><label>Description: </label> <textarea name="description"> </textarea> </p>
            <input type="submit">
        </fieldset>

    </form>

@endsection