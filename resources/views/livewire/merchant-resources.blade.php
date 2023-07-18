<div>
    @include('partials.merchant-dash-header')
    <div class="flex font-poppins">
        @include('partials.merch-sidebar')
        <div>
            <div class="min-h-screen py-8 pl-8">
                <h3 class="text-4xl mb-4 text-secondary-dark">
                    Resources
                </h3>
                <p class="text-gray-600 mb-12">Following are Sacki resources included in your subscription</p>
                <h3 class="text-xl mb-4 text-secondary-dark">
                    Categories
                </h3>
                <div class="flex flex-wrap gap-4 mb-12">
                    @include('partials.category-tag', ['categoryName' => 'Unconscious Bias', 'categoryKey' => 'UNCONSCIOUS_BIAS'])
                    @include('partials.category-tag', ['categoryName' => 'Inclusive Communication & Marketing', 'categoryKey' => 'INCLUSIVE_COMMUNICATION_AND_MARKETING'])
                    @include('partials.category-tag', ['categoryName' => 'Anti-Discrimination Resources', 'categoryKey' => 'ANTI_DISCRIMINATION_RESOURCES'])
                    @include('partials.category-tag', ['categoryName' => 'Diverse and Inclusive Teams', 'categoryKey' => 'DIVERSE_AND_INCLUSIVE_TEAMS'])
                    @include('partials.category-tag', ['categoryName' => 'Consumer Trends', 'categoryKey' => 'CONSUMER_TRENDS'])
                    @include('partials.category-tag', ['categoryName' => 'Maximizing Your Data', 'categoryKey' => 'MAXIMIZING_YOUR_DATA'])
                </div>
                <div class="flex">
                    <div class="w-1/3">
                        <h3 class="text-xl mb-8 text-secondary-dark">
                            Train Your Team!
                        </h3>
                        @if(isset($trainingData))
                            <div class="mr-20 space-y-6">
                                @foreach($trainingData as $row)
                                    @include('partials.training-link', ['header'=> $row->name, 'body' =>  substr($row->description, 0, 125) . '...', 'link' => '#', 'thumbnail'=> $row->thumbnail,'url'=> $row->url])
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <div class="w-1/2">
                        <h3 class="text-xl mb-8 text-secondary-dark">
                            Recent Posts
                        </h3>
                        <div class="space-y-12">
                            <div wire:loading wire:target="loadList">
                                Loading Posts...
                            </div>
                            @if(isset($posts))
                                @foreach($posts as $post)
                                    @include('partials.learning-article', ['compact' => true, 'postData' => $post])
                                @endforeach
                            @else
                                <p>No new post found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>