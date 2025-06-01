<tr class="{{ $level > 0 ? 'bg-light' : 'bg-white' }}">
<td  style="padding-left: {{$level * 40}}px;">#{{ $index }}</td>
    <td style="padding-left: {{$level * 40}}px;">
        <div class="d-flex align-items-center">
            <div class="recent-product-img">
                <img
                        src="{{ $category->category_image }}"
                        alt="">
            </div>
        </div>
    </td>
    <td style="padding-left: {{$level * 40}}px;">{{ $category->category_name }}</td>
    <td style="padding-left: {{$level * 40}}px;">
        <div class="d-flex order-actions"><a
                    href="{{ route('panel.edit.category',$category->id) }}"><i
                        class="bx bx-edit"></i></a>
            <a href="{{ route('panel.delete.category',$category->id) }}" id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
        </div>
    </td>
</tr>
@if(isset($category->children) && $category->children->count() > 0)
    @php($childIndex = 1)
    @foreach($category->children as $child)
        @include('admin.category.sub-category', ['category' => $child, 'level' => $level + 1, 'index' => $index . '-' . $childIndex])
        @php($childIndex++)
    @endforeach
@endif

