@extends('layouts.app')


@section('content')
<link rel="stylesheet" href= "{{ asset('css/contact.css') }}">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Contact Logo Teams</h3>
    @if(Session::get('success'))
    <div class="message">
        Thank you for contacting us, we will get back to you as soon as possible.
    </div>
        @endif
    <div class="mail">
    <form method="post" action="{{ route('sendEmail') }}">
        @csrf
        <label for="name">Name</label><br>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="message">Message</label><br>
        <textarea id="message" name="message" rows="4" required></textarea><br>
        <input type="submit" value="Submit">
    </form>
    </div> 
</body>
</html>

@endsection