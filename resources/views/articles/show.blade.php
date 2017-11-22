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
<div class="col-lg-5"></div>
<div class="col-lg-1">
	<h3><i><u>Comments</u></i></h3>
    <br>

<!-- 	{!! Form::open(['route' => 'comments.store', 'class' => 'form-horizontal', 'role' => 'form']) !!}

	<div class="form-group">
	{!! Form::label('article_id', 'Title', array('class' => 'col-lg-3 control-label', 'hidden')) !!}

	<div class="col-lg-9">
	{!! Form::text('article_id', $value = $article->id, array('class'=>'hidden', 'form-control', 'readonly')) !!}
	</div>
	<div class="clear">
	</div>
</div> -->
</div>

<!-- <div class="row">
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
		<table class="table table-bordered">
		<th scope="row"><p>{!! $comment->content !!}</p>
    	<p>by : {!! $comment->user !!}</p>
    	</th>
		</table>
	@endforeach
</div>
</div>
</div> -->

<div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul>
                    <a href="#" class="add-modal"><li>Add a Comment</li></a>
                </ul>
            </div>
        
            <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
                        <thead>
                            <tr>
                                <th valign="middle">#</th>
                                <th>Comments</th>
                                <th>User</th>
                                <th>Last updated</th>
                                <th>Actions</th>
                            </tr>
                            {{ csrf_field() }}
                        </thead>
                        <tbody>
                            @foreach($comments as $indexKey => $komen)
                                <tr class="item{{$komen->id}} ">
                                    <td class="col1">{{ $indexKey+1 }}</td>
                                    <td>{{App\Comment::getExcerpt($komen->content)}}</td>
                                    <td>
                                        {{$komen->user}}
                                    </td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $komen->updated_at)->diffForHumans() }}</td>
                                    <td>
                                        <button class="show-modal btn btn-primary" data-id="{{$komen->id}}" data-title="{{$komen->content}}" data-content="{{$komen->user}}">
                                        <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                        <button class="edit-modal btn btn-success" data-id="{{$komen->id}}" data-title="{{$komen->content}}" data-content="{{$komen->user}}">
                                        <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                        <button class="delete-modal btn btn-danger" data-id="{{$komen->id}}" data-title="{{$komen->content}}" data-content="{{$komen->user}}">
                                        <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
    </div>

    <div id="addModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
                      {{ Form::hidden('article_id',  $value = $article->id, array('id' => 'id_add')) }}
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Comment</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content_add" cols="40" rows="5"></textarea>
                                <small>Min: 2, Max: 32, only text</small>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">User</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="user_add" autofocus>
                                <small>User</small>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success add" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-check'></span> Add
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div id="showModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Content:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="title_show" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">User:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content_show" cols="40" rows="5" disabled></textarea>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_edit" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="title">Title:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="title_edit" autofocus>
                                <p class="errorTitle text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="content">Content:</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="content_edit" cols="40" rows="5"></textarea>
                                <p class="errorContent text-center alert alert-danger hidden"></p>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary edit" data-dismiss="modal">
                            <span class='glyphicon glyphicon-check'></span> Edit
                        </button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</article>
@stop