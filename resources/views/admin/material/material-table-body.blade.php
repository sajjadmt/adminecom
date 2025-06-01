@php($i = 1)
@foreach ($materials as $material)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $material->title }}
        </td>
        <td class="text-center">
                                                            <span class="material-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $material->id }}">
                                                                {{ $material->status }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.material',$material->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.material',$material->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
