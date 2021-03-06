@extends('layout')
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.0/react-dom.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.6.15/browser.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/babel" src="{{ asset('js/todolist.jsx') }}"></script>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
@stop

@section('content')
    <div class="container">
        <div id="list_content" class="content"></div>
    </div>
@stop