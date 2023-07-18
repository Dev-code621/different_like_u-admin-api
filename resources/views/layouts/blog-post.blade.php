@extends('layouts.app')
@include('partials.merchant-dash-header')
<div class="flex">
    @include('partials.merch-sidebar')
    <div class="flex flex-col w-full blog">
        <div class="w-full h-96 pt-6"
             style="background:  linear-gradient(180deg, rgba(0, 49, 82, 0) 29.06%, #003152 100%), center / cover no-repeat url('{{ !empty($post->image) ? Helper::getPrivateBucket($post->image) : Helper::getBackgroundPlaceholder() }}')">
        </div>
        <div class="flex flex-col items-start p-8 w-1/2">
            <div class="flex flex-col items-start bg-white -mt-40 p-8 shadow rounded-lg">
                <p class="text-xs text-white bg-orange-primary uppercase mb-4 px-4 py-1 rounded-lg">{{str_replace('_', ' ', $post->category)}}</p>
                <p class="text-secondary-dark text-5xl font-bold mb-6">{{$post->title}}</p>
                <p>Posted on {{ \Carbon\Carbon::parse($post->created_at)->format('F d, Y') }}</p>
            </div>
        </div>
        <div class="flex justify-between p-8">
            <div class="mr-10 leading-loose">
                {!! $post->content !!}
            </div>
            <div class="-mt-24">
                <div class="border-2 border rounded-lg w-64  mb-8">
                    <div class="flex items-center  p-6">
                        <img src="{{ !empty($post->user->avatar) ? Helper::getPrivateBucket($post->user->avatar) : Helper::getAvatarPlaceholder() }}"
                             class="w-20 h-20 mr-4 border-2 border-orange-secondary rounded-full"/>
                        <div>
                            <p class="font-bold text-secondary-blue mb-2">{{App\User::find($post->user_id)->name}}</p>
                            <!-- <p class="text-sm text-gray-600">Title</p> -->
                        </div>
                    </div>
                    <!-- <div class="p-4 border-t-2 flex justify-center">
                        <a class="text-orange-secondary text-xs font-bold">VIEW ALL POSTS</a>
                    </div> -->
                </div>
                <p class="text-xl font-bold text-blue-primary mb-4">Featured Posts</p>
                <div class="space-y-4 flex flex-col">
                    @if(isset($postList))
                        @foreach($postList as $posts)

                            @include('partials.blog-featured',['compact' => true, 'postData' => $posts])

                        @endforeach
                    @else
                        <p>No new post found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.blog pre{
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;
    border-left: 2px solid #000C14;
    padding-left: 68px; 
}
.blog ul{
    padding-left: 2rem;
}
.blog ol, ul {
    list-style: unset !important;
}
figcaption.attachment__caption {
    display: none;
}
</style>
