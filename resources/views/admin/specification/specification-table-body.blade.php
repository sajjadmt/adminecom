@php($i = 1)
@foreach ($specifications as $specification)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $specification->title }}
        </td>
        <td class="text-center">
                                                            <span class="spec-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $specification->id }}">
                                                                {{ $specification->status }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                        href="{{ route('panel.edit.specification',$specification->id) }}"><i
                            class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.specification',$specification->id) }}"
                   id="delete" class="ms-4"><i
                            class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
