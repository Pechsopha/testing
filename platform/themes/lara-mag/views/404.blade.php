@extends('theme.' . setting('theme') . '::views.error-master')

@php
    SeoHelper::setTitle(__('Page could not be found'));
@endphp

@section('message')
    <br>
    <br>
    <h1>{{ __('Page could not be found') }}</h1>
    <br>
    <br>
    <h4>{{ __('This may have occurred because of several reasons') }}:</h4>
    <ul>
        <li>{{ __('The page you requested does not exist.') }}</li>
        <li>{{ __('The link you clicked is no longer.') }}</li>
        <li>{{ __('The page may have moved to a new location.') }}</li>
        <li>{{ __('An error may have occurred.') }}</li>
        <li>{{ __('You are not authorized to view the requested resource.') }}</li>
    </ul>
    <br>
    <br>
@endsection

