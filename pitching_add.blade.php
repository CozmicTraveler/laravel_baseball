@extends('layouts.helloapp')

@section('title','BaseballStats.add')

@section('menubar')
  @parent
  Create new page
@endsection

@section('content')
  @if(count($errors)>0)
  <div>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <form action="baseball_add" method="post">
  <table>
    @csrf
    <tr><th>team: </th><td><input type="text" name="team" value="{{old('team')}}"></td></tr>
    <tr><th>name: </th><td><input type="text" name="name" value="{{old('name')}}"></td></tr>
    <tr><th>game: </th><td><input type="number" name="game" value="{{old('game')}}"></td></tr>
    <tr><th>batter: </th><td><input type="number" name="batter" value="{{old('batter')}}"></td></tr>
    <tr><th>ip: </th><td><input type="number" name="ip" value="{{old('ip')}}"></td></tr>
    <tr><th>so: </th><td><input type="number" name="so" value="{{old('so')}}"></td></tr>
    <tr><th>bb: </th><td><input type="number" name="bb" value="{{old('bb')}}"></td></tr>
    <tr><th>ib: </th><td><input type="number" name="ib" value="{{old('ib')}}"></td></tr>
    <tr><th>db: </th><td><input type="number" name="db" value="{{old('db')}}"></td></tr>
    <tr><th>hit: </th><td><input type="number" name="hit" value="{{old('hit')}}"></td></tr>
    <tr><th>hr: </th><td><input type="number" name="hr" value="{{old('hr')}}"></td></tr>
    <tr><th>wild: </th><td><input type="number" name="wild" value="{{old('wild')}}"></td></tr>
    <tr><th></th><td><input type="submit" value="send"></td></tr>
  </table>
  </form>
@endsection

@section('footer')
copylight 2023 KN
@endsection
