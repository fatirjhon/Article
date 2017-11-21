<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="{{{ asset('source_img/favicon.png') }}}">
<meta charset="utf-8">
<meta httpequiv="XUACompatible" content="IE=edge">

<meta name="viewport" content="width=device-width, initial-
scale=1">

<title>Articles</title>

<link href="/css/style.css" rel="stylesheet" />

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
</body>

</html>