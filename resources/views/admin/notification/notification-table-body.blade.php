@php($i = 1)
@foreach ($notifications as $notification)
    <tr class="{{ $notification->status == 'unread' ? 'text-black' : 'text-secondary' }}">
        <td>{{ $i++ }}</td>
        <td>
            <img src="{{ $notification->user->profile_photo_path }}" class="user-img" alt="user avatar"> {{ $notification->user->name }}
        </td>
        <td>
            {{ Str::limit($notification->title, 20, '...') }}
        </td>
        <td>
            {{ Str::limit($notification->message, 30, '...') }}
        </td>
        <td>
                                                            <span class="notification-status"
                                                                  style="cursor: pointer;"
                                                                  data-id="{{ $notification->id }}">
                                                                {{ ucfirst($notification->status) }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center">
                <a href="{{ route('panel.delete.notification',$notification->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
