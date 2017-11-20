@extends("layouts.application")
@section("content")
<div class="row">
<h2 class="pull-left">List Articles</h2>
<br>
<div class="col-lg-2">
{!! link_to(route("articles.create"), "Create new Article", ["class"=>"pull-right btn btn-raised btn-success"])!!}
</div>
</div>
@include('articles.list')
@stop