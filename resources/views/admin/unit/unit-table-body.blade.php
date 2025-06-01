@php($i = 1)
@foreach ($units as $unit)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $unit->title }}
        </td>
        <td class="text-center">
                                                            <span class="unit-status"
                                                                  style="cursor: pointer; color:black"
                                                                  data-id="{{ $unit->id }}">
                                                                {{ $unit->status }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.unit',$unit->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.unit',$unit->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
