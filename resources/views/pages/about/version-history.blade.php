@extends('layouts.master')

@section('title')
    Version History
@endsection

@section('description')
    {{ env('APP_NAME') }} Web Service Version History
@endsection

@section('content')
    <h2>Version History</h2>
    <h3 class="h5 padding">{{ env('APP_NAME') }} 1.0.1 <small>Release Date: 10/23/18 </small></h3>
    <strong>Improvements:</strong>
    <ol>
        <li>Update the landing pages to include the latest version of <a href="//csun-metalab.github.io/metaphorV2/">Metaphor</a>.</li>
    </ol>
    <hr class="margin">
    <h3 class="h5 padding">{{ env('APP_NAME') }} 1.0.0 <small>Release Date: 02/06/18 </small></h3>
    <strong>New Features:</strong>
    <ul>
        <li>Ability to retrieve faculty member listing by department</li>
        <li>Ability to filter campus faculty member listing by last name</li>
        <li>Ability to filter faculty member listings by status: all, tenure-track, emeriti, or lecturers</li>
        <li>Ability to retrieve faculty member degree information</li>
    </ul>
    <hr class="margin">
    <h3 class="h5 padding">{{ env('APP_NAME') }} Beta <small>Release Date: 12/12/17</small></h3>
    <strong>New Features:</strong>
    <ol>
        <li>Ability to POST and create new users to the Databases.</li>
    </ol>
    <hr class="margin">
@endsection