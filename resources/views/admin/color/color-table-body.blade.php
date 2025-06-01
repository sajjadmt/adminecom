@php($i = 1)
@foreach ($colors as $color)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $color->color_name }}
        </td>
        <td class="text-center">
                                                            <span class="color-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $color->id }}">
                                                                {{ $color->status }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.color',$color->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.color',$color->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
