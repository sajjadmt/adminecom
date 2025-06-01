@php($i = 1)
@foreach ($sizes as $size)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $size->size }}
        </td>
        <td class="text-center">
                                                            <span class="size-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $size->id }}">
                                                                {{ $size->status }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.size',$size->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.size',$size->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
