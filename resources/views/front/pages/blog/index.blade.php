@extends('front.layouts.app')
@section('title', 'Blog')
@section('mainContent')
        <div class="container">
            <div class="about-us">
                <div class="sec-title"><span class="color-red">Blogs</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                <div class="row">
                    @if($blog_list->count() > 0)
                    @foreach($blog_list as $blog)
                    <div class="col-md-4">
                        <div class="blog-box">
                            <div class="bb-img">
                                @if(!empty($blog->blog))
                                <img src="{{asset('storage/blog').'/'.$blog->blog}}" alt="">
                                @else
                                <img src="{{asset('storage/blog/blog.png')}}" alt="">
                                @endif
                            </div>
                            <div class="bb-detail">
                                <div class="bb-title">{{$blog->title}}</div>
                                <div class="bb-subTitle">{{ date('M-d-Y', strtotime($blog->created_at)) }}</div>
                                {{ Str::words($blog->description, 15)}}
                                <a href="{{route('blogdetail',$blog->id)}}" class="bb-btn"><img src="{{asset('images/right-arrow-white.png') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                        @else
                        <div class="col-md-12">
                            <div class="blog-box">
                                <div class="bb-detail" style="text-align: center"><b>Record Not Found Blog</b></div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
@endsection
<style type="text/css">
.bb-detail{
    height: 194px;
}
</style>