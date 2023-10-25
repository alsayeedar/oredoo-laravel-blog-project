@if ($categories->count() > 0)
<div class="categories">
    <div class="container-fluid">
        <div class="categories-area">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="categories-items">
                        @foreach ($categories as $category)
                        <a class="category-item" href="{{ route("frontend.category", $category->slug) }}">
                            <div class="image">
                                <img src="{{ asset("uploads/category/".($category->image ?? "default.webp")) }}" alt="{{ $category->title }}"/>
                            </div>
                            <p>{{ $category->title }}<span>{{ count($category->posts->where("status", true)) }}</span></p>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
