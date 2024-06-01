@extends('home.app')

@section('title', 'Thank you customer')

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead">Your order has been successfully placed.</p>
    <hr>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="{{ url("/") }}" role="button">Continue Shopping</a>
    </p>
    <p>If you have any questions or concerns, please feel free to <a href="https://example.com/contact">contact us</a>.</p>
</div>

@endsection
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        .jumbotron {
            padding: 4rem 2rem;
            margin: 2rem 0;
        }
        .display-3 {
            font-size: 4rem;
        }
        .lead {
            font-size: 1.5rem;
        }
        .btn-primary {
            font-size: 1.25rem;
            padding: 0.75rem 1.25rem;
        }
    </style>
</head>
