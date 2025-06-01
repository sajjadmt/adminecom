@php($i = 1)
@foreach ($products as $product)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            <div style="justify-content: center" class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div class="recent-products-img">
                        <a class="image-btn" style="color: black" href="javascript:void(0);"
                           data-image="{{ $product->images[0]->url }}"><img
                                src="{{ $product->images[0]->url }}" title="{{ $product->title }}"></a>
                    </div>
                </div>
            </div>
        </td>
        <td class="text-left">
            <a class="details-btn" style="color: black" href="javascript:void(0);"
               data-url="{{ route('panel.product.detail', $product->id) }}">{{ Str::limit($product->title, 40, ' ...') }}</a>
        </td>
        <td>{{ $product->category->category_name }}</td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center">
                <a class="variants-btn" href="javascript:void(0);"
                   data-url="{{ route('panel.product.variants',$product->id) }}"><i class="bx bx-detail"></i></a>
                <a href="{{ route('panel.create.variant',$product->id) }}" class="ms-4"><i class="bx bx-add-to-queue"></i></a>
            </div>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center">
                <a href="{{ route('panel.edit.product',$product->id) }}"><i class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.product',$product->id) }}" id="delete" class="ms-4"><i class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
