<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="{{{ asset('source_img/favicon.png') }}}">
<meta charset="utf-8">
<meta httpequiv="XUACompatible" content="IE=edge">
<meta name="_token" content="{{ csrf_token() }}"/>

<meta name="viewport" content="width=device-width, initial-
scale=1">

<title>Articles</title>

<link href="/css/style.css" rel="stylesheet" />

{{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<link href="/css/bootstrap.css" rel="stylesheet" />

<link href="/css/material-design/bootstrap-material-
design.css" rel="stylesheet" />

<link href="/css/material-design/ripples.css"
rel="stylesheet" />
<link href="/css/custom/layout.css" rel="stylesheet" />l
</head>
<body style="padding-top:40px;">
<!--bagian navigation-->
@include('shared.head_nav')
<!-- Bagian Content -->
<div class="container clearfix">
<div class="row row-offcanvas row-offcanvas-left ">
<!--Bagian Kiri-->
<!-- @include("shared.left_nav")
<!--Bagian Kanan-->

<div id="main-content" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="panel-body">
@if (Session::has('error'))
<div class="session-flash alert-danger">
{{Session::get('error')}}
</div>
@endif
@if (Session::has('notice'))
<div class="session-flash alert-info">
{{Session::get('notice')}}

</div>
@endif
@yield("content")

<div class="container clearfix">
	@include("shared.foot_nav")
</div>
</div>
</div>
</div>
<script src="/js/jquery/jquery-2.2.5.js"></script>
<script src="/js/bootstrap/bootstrap.js"></script>
<script src="/js/material-design/material.js"></script>
<script src="/js/material-design/ripples.js"></script>
<script src="/js/custom/layout.js"></script>

{{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

{{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

{{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(window).load(function(){
            $('#postTable').removeAttr('style');
        })
    </script>

<script type="text/javascript">
      //add
      $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: '{{ URL::route('comments.store') }}',
                data: {
                    '_token': $('#_token').val(),
                    'article_id': $('#id_add').val(),
                    'content': $('#content_add').val(),
                    'user': $('#user_add').val()
                },
                success: function(data) {
                    $('.errorContent').addClass('hidden');
                    $('.errorUser').addClass('hidden');
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);
                        if (data.errors.content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.content);
                        }
                        if (data.errors.user) {
                            $('.errorUser').removeClass('hidden');
                            $('.errorUser').text(data.errors.user);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#postTable').prepend("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.content + "</td><td>" + data.user + "</td><td>Just now!</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-content='" + data.content + "' data-user='" + data.user + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-content='" + data.content + "' data-user='" + data.user + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-content='" + data.title + "' data-user='" + data.user + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                },
            });
        });

        $(document).on('click', '.show-modal', function() {
            $('.modal-title').text('Show');
            $('#id_show').val($(this).data('id'));
            $('#title_show').val($(this).data('title'));
            $('#content_show').val($(this).data('content'));
            $('#showModal').modal('show');
        });

        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#content_edit').val($(this).data('content'));
            $('#user_edit').val($(this).data('user'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: '{{ URL::route('comments.store') }}' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'article_id': $('#id_add').val(),
                    'content': $('#content_edit').val(),
                    'user': $('#user_edit').val()
                },
                success: function(data) {
                    $('.errorTitle').addClass('hidden');
                    $('.errorContent').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.title) {
                            $('.errorTitle').removeClass('hidden');
                            $('.errorTitle').text(data.errors.title);
                        }
                        if (data.errors.content) {
                            $('.errorContent').removeClass('hidden');
                            $('.errorContent').text(data.errors.content);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.content + "</td><td>" + data.user + "</td><td>Just now!</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-content='" + data.content + "' data-user='" + data.user + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-content='" + data.content + "' data-user='" + data.user + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-content='" + data.title + "' data-user='" + data.user + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });

        $(document).on('click', '.delete-modal', function() {
            $('.modal-title').text('Delete');
            $('#id_delete').val($(this).data('id'));
            $('#title_delete').val($(this).data('title'));
            $('#deleteModal').modal('show');
            id = $('#id_delete').val();
        });
        $('.modal-footer').on('click', '.delete', function() {
            $.ajax({
                type: 'DELETE',
                url: '{{ URL::route('comments.store') }}' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function(data) {
                    toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                    $('.item' + data['id']).remove();
                    $('.col1').each(function (index) {
                        $(this).html(index+1);
                    });
                }
            });
        });

    </script>

</body>

</html>