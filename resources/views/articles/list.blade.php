@foreach($articles as $article)
<article class="row">
<h1>{!!$article->title!!}</h1>
<div class='col-md-2'>
<a class="thumbnail fancybox" rel="ligthbox" href="/images/{{ $article->image }}">
<img class="img-responsive" alt="" src="/images/{{ $article->image }}" />
</a> </div>
{!! str_limit($article->content, 250) !!}
{!! link_to(route('articles.show', $article->id), 'Read More') !!}
</article>
@endforeach