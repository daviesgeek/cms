@extends('layout')

<h1>{{$h1}}</h1>

@section('content')
  @include('editor', array('section' => 'main'))
@stop