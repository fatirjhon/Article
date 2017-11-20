@extends("layouts.application")
@section("content")
<article>

<div class="col-lg-12">
	<h1>{!! $article->title !!}</h1>
<div class='col-md-3'>
<a class="thumbnail fancybox" rel="ligthbox" href="/images/{{ $article->image }}">
<img class="img-responsive" alt="photo" src="/images/{{ $article->image }}" />
</a> </div>
	<p>{!! $article->content !!}</p>

</div>

<div class="col-lg-12">
{!! Form::open(array('route' => array('articles.destroy', $article->id), 'method' => 'delete', 'files' => 'true')) !!}
{!! link_to(route('articles.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}
{!! link_to(route('articles.edit', $article->id), 'Edit', ['class'=> 'btn btn-raised btn-warning']) !!}
{!! Form::submit('Delete', array('class' => 'btn btn-raised btn-danger', "onclick" => "return confirm('are you sure?')")) !!}
{!! Form::close() !!}
</div>

<div class="row">
<div class="col-lg-12">
	<h3><i><u>Give Comments</u></i></h3>

	{!! Form::open(['route' => 'comments.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

	<div class="form-group">
	{!! Form::label('article_id', 'Title', array('class' => 'col-lg-3 control-label', 'hidden')) !!}

	<div class="col-lg-9">
	{!! Form::text('article_id', $value = $article->id, array('class'=>'hidden', 'form-control', 'readonly')) !!}
	</div>
	<div class="clear">
	</div>
</div>

<div class="row">
<div class="col-lg-12">
<div class="col-lg-8">
<div class="form-group">
	{!! Form::label('content', 'Content', array('class' => 'col-lg-1 control-label')) !!}
	<div class="col-lg-10">

	{!! Form::textarea('content', null, array('class' => 'form-control', 'rows' => 10, 'autofocus' => 'true')) !!}

	{!! $errors->first('content') !!}
	</div>
	<div class="clear">
	</div>
</div>

<div class="form-group">
	{!! Form::label('user', 'User', array('class' => 'col-lg-1 control-label',)) !!}
	<div class="col-lg-10">
		<input type="email" name="user" id="user" class="form-control" placeholder="User must an email">
	<!-- {!! Form::text('user', null, array('class' => 'form-control'))!!} -->
	</div>
	<div class="clear">
	</div>
</div>

<div class="form-group">
	<div class="col-md-1"></div>
	<div class="col-md-1">
	{!! Form::submit('Save', array('class' => 'btn btn-primary'))!!}
	</div>
	<div class="clear">
	</div>
</div>
</div>

<div class="col-lg-4">
	{!! Form::close() !!}
	@foreach($comments as $comment)
	<!-- <div style="padding: 6px; outline: 2px solid #74AD1B;"> -->
		<table class="table table-bordered">
		<th scope="row"><p>{!! $comment->content !!}</p>
    	<p>by : {!! $comment->user !!}</p>
    	</th>
		<!-- <p>{!! $comment->content !!}</p>
		<i>by : {!! $comment->user !!}</i> -->
		</table>
		<!-- <br>
	</div> -->
	@endforeach
</div>
</div>
</div>

</article>
@stop