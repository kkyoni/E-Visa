@extends('front.layouts.app')
@section('title', 'Blog Detail')
@section('mainContent')
        <div class="container">
            <div class="about-us">
                <div class="sec-title">Blog <span class="color-red">Detail</span> <img src="{{asset('images/plane-right.png') }}" alt=""></div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="blog-box blogDetail-box">
                            <div class="bb-img">
                                @if(!empty($blog_detail->blog))
                                    <img src="{{asset('storage/blog').'/'.$blog_detail->blog}}" alt="">
                                @else
                                    <img src="{{asset('storage/blog/blog.png')}}" alt="">
                                @endif
                                    </div>
                            <div class="bb-detail">
                                <div class="bb-title">{{$blog_detail->title}}</div>
                                <div class="bb-subTitle">{{ date('M-d-Y', strtotime($blog_detail->created_at)) }}</div>
                                <p>{{$blog_detail->description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
