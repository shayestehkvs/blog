@extends('home.master')

@section('content')

    <!-- slider section -->
    @include('home.layouts.slider')
    <!-- end slider section -->
    <!-- why section -->

    <!-- end why section -->
    @include('home.why')
    <!-- arrival section -->
    @include('home.arrival')
    <!-- end arrival section -->

    <!-- product section -->
    @include('home.product')

    <!-- end product section -->

    <!-- subscribe section -->
    @include('home.subscribe')
    <!-- end subscribe section -->
    <!-- client section -->
    @include('home.client')
    <!-- end client section -->

@endsection
