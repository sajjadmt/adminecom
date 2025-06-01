@php($i = 1)
@foreach ($users as $user)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            <div style="justify-content: center"
                 class="d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <div class="recent-products-img">
                        <img
                            src="{{ $user->profile_photo_path }}"
                            title="{{ $user->name }}">
                    </div>
                </div>
            </div>
        </td>
        <td class="text-center">
            {{ ucfirst($user->name) }}
        </td>
        <td class="text-center">
            {{ ucfirst($user->role) }}
        </td>
        <td class="text-center">
            @if($user->role === 'admin')
                <span style="pointer-events: none; color:dimgray">
                                                                {{ ucfirst($user->status) }}
                                                            </span>
            @else
                <span class="user-status"
                      style="cursor: pointer; color:black"
                      data-id="{{ $user->id }}">
                                                                {{ ucfirst($user->status) }}
                                                            </span>
            @endif
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.user',$user->id) }}"><i
                        class="bx bx-edit"></i></a>
                @if($user->role === 'customer')
                    <a href="{{ route('panel.delete.user', $user->id) }}"
                       id="delete" class="ms-4">
                        <i class="bx bx-trash"></i>
                    </a>
                @else
                    <a href="javascript:void(0);"
                       class="ms-4 disabled-delete"
                       style="pointer-events: none; opacity: 0.5;">
                        <i class="bx bx-trash"></i>
                    </a>
                @endif
            </div>
        </td>
    </tr>
@endforeach
