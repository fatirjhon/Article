@extends("layouts.application")
@section("content")
<h3>Create an Article</h3>

{!! Form::open(['route' => 'articles.store', 'files' => 'true', 'class' => 'form-horizontal', 'role' => 'form']) !!}
<br>

@include('articles.form')
{!! Form::close() !!}
@stop