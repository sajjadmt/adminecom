<option value="{{ $category->id }}">
    {!! str_repeat('-', $level) !!} {{ $category->category_name }}
</option>

@if($category->children->count())
    @foreach($category->children as $child)
        @include('admin.category.category-options', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
