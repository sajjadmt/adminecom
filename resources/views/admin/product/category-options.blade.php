<option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) == $category->id) ? 'selected' : '' }}>
    {!! str_repeat('-', $level) !!} {{ $category->category_name }}
</option>

@if($category->children->count())
    @foreach($category->children as $child)
        @include('admin.product.category-options', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif
