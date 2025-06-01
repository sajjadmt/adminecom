@php($index=1)
@foreach ($categories as $category)
    @include('admin.category.sub-category',['category' => $category,'level' => 0,'index'=>$index])
    @php($index++)
@endforeach
