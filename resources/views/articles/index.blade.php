@extends('app')

@section('content')
    @if(isset($user))
	@include('users.partials.infonav')
	@else
    <nav id="myScrollspy" class = "hidden-xs hidden-sm col-md-1">
	    <ul class="nav nav-pills nav-stacked articles-title-sidebar">
	    @foreach($articles as $article)
	    <li><a href="#{{$article->photo}}">{{mb_substr($article->title, 0, 4,'utf-8')}}</a></li>
	    @endforeach
	    </ul>
    </nav>
    @endif

    <div class= "col-md-7">
		<ul class="list votebookmark">	
		@unless (!$search)
	    <br>搜索：{{$search}}的结果
	    @endif
	  @if (count($articles))
		@foreach($articles as $article)
		<span class="anchor" id="{{$article->photo}}"></span>
		<article class="list-item"  style="margin-top: 0px;">
		    <div class = "width480">
			<a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank" ><h3 class="index-article-title">{{$article->title}}
            </h3></a>
			</div>

			    @if($article->type == '.jpg')
			    <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
			    <img src="/images/catalog/{{$article->photo}}{{$article->type}}" alt="{{$article->title}}"></a>
			    @endif
			    @if($article->type == '_long.jpg')
		        <div class="long-post-wrap">
			    <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">
			    <img src="/images/catalog/{{$article->photo}}.jpg" alt="{{$article->title}}"></a>
		        <a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank"class="post-read-more"><i class="glyphicon glyphicon-new-window"></i>&nbsp;&nbsp;查看完整</a>       
		        </div>
			    @endif
			    @if($article->type == '.mp4')
			    <div class = "video_wrap">
			    <h2 class="video_text">Gif</h2>
			    <video  width="480" style="max-height:500px;min-height:300px" loop preload="auto" >
				  <source src="/images/catalog/{{$article->photo}}{{$article->type}}" type="video/mp4">
				Your browser does not support the video tag.
				</video>
				</div>
				@endif	 
			<a href="{{ action('ArticlesController@show', [$article->photo])}}"target="_blank">  
			    <h4 style="margin-bottom:2px;"><span class="label label-default inline-block"><span id="b{{$article->photo}}">{{$article->vote_count}}</span>&nbsp;赞
				<span>&nbsp;•&nbsp;</span>{{$article->reply_count}}&nbsp;互动
				<span>&nbsp;•&nbsp;</span>{{$article->view_count}}&nbsp;观摩</span>
				@if(!$article->reply_count == 0)
				<span class="label label-default inline-block">热槽：
                {{mb_substr(\App\Reply::where('article_id', $article->id)->orderBy('vote_count', 'desc')->firstOrFail()->body, 0, 22,'utf-8')}}</span>
                @endif
				</h4>
			</a>       
			<div class="width480">
			<div class="pull-left">
				<ul class="btn-vote-reply">
			    <li><button  type="button" 	
				         class="btn btn-default index-upvote"	           
				         data-id="{{$article->photo}}"
				         data-title="{{$article->title}}"
				         data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="点赞"><i class="glyphicon glyphicon-thumbs-up"></i>
			    </button></li>
			    <li><button  type="button" 	
				         class="btn btn-default index-bookmark"
				         data-id="{{$article->photo}}"
				         data-title="{{$article->title}}"
				         data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="书签"><i class="glyphicon glyphicon-bookmark"></i>        
			    </button></li>
			    <li><a href="{{ action('ArticlesController@show', [$article->photo])}}" target="_blank">
			    <button  type="button" 	
				         class="btn btn-default"
				         data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="互动"><i class="glyphicon glyphicon-comment"></i>         
			    </button>
			    </a></li>
			    </ul>
			</div>
	        <div class="pull-right bdsharebuttonbox" data-tag="share_1">
	        <a class="iconfont icon-weixin" data-cmd="weixin" href="#" data-photo="{{$article->photo}}" data-trigger="hover" data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享微信"></a>
	        <a class="iconfont icon-weibo" data-cmd="tsina"href="#" data-photo="{{$article->photo}}" data-trigger="hover" data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享微博"></a>
	        <a class="iconfont icon-qqkongjian" data-cmd="qzone" href="#"data-photo="{{$article->photo}}" data-trigger="hover" data-type="{{$article->type}}"data-title="{{$article->title}}"data-toggle="tooltip" data-placement="bottom" title="分享QQ空间"></a>	        
	        </div> 
	        </div>
		    <div class="clearfix"></div>

		</article>			      
	    <hr>
		@endforeach
	  @else
        <div class="empty-block">没有任何记录哦~~</div>
      @endif
	    </ul><h1>{!!$articles->appends(Request::except('page'))->render()!!}</h1>
    </div>
    @include('sidebarful')
@stop
