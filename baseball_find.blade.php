@extends('layouts.helloapp')

@section('title','Baseball.find')

@section('menubar')
  @parent
  Search page
@endsection

@section('content')
  <form action="/baseball/find" method="post">
  @csrf
  <input type="text" name="input" value="{{$input}}">
  <input type="submit" value="send">
  </form>
  @if(isset($item))
  <table>
  <tr><th>Data</th></tr>
  <tr>
    <td>{{$item->getData()}}</td>
  </tr>
  </table>
  @endif
@endsection

@section('footer')
copylight 2023 KN
@endsection
