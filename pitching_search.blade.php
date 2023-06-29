@extends('layouts.helloapp')

@section('title','Baseball.find')

@section('menubar')
  @parent
  Search page
@endsection

@section('content')
  <form action="/pitcher/search" method="post">
  @csrf
  <p>Player name</p>
  <input type="text" name="name" >
  <input type="submit" value="send">
  </form>

@section('footer')
copylight I'm feelin' tha VOODOO in my brain.
@endsection
