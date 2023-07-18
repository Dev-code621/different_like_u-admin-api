<div class="space-y-8 w-1/2">
    @if(count($posts) > 0)
        <h3 class="text-2xl">
            Learn, Diversify & Grow
        </h3>

        @foreach($posts as $post)
            @include('partials.learning-article', [ 'postData' => $post])
        @endforeach
    @endif
</div>