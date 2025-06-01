@php($i = 1)
@foreach ($attributes as $attribute)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $attribute->title }}
        </td>
        <td class="text-center">
            {{ $attribute->specification->title }}
        </td>
        <td class="text-center">
                                                            <span class="spec-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $attribute->id }}">
                                                                {{ $attribute->status }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.attribute',$attribute->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.attribute',$attribute->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
