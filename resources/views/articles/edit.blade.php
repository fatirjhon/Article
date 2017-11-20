@extends("layouts.application")
@section("content")
<h3>Edit Article</h3>
{!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'put', 'files' => 'true', 'class' => 'form-horizontal', 'role' =>'form']) !!}
@include('articles.form')
{!! Form::close() !!}
@stop