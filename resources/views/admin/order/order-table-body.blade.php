@foreach ($orders as $order)
    <tr>
        <td>{{ $order->order_no }}</td>
        <td>
            <img class="user-img"
                 src="{{ $order->user->profile_photo_path }}"
                 alt=""> {{ ucfirst($order->user->name) }}
        </td>
        <td class="{{ $order->payment_status === 'paid' ? 'text-success' : 'text-danger' }}">
            {{ ucfirst($order->payment_status) }}
        </td>
        <td>
            {{ $order->total_price }}
        </td>
        <td class="@switch($order->status)
                                                            @case('pending')
                                                            text-warning
                                                            @break
                                                            @case('cancelled')
                                                            text-danger
                                                            @break
                                                            @case('processing')
                                                            text-info
                                                            @break
                                                            @case('completed')
                                                            text-success
                                                            @break
                                                            @endswitch">{{ ucfirst($order->status) }}</td>
        <td>
            {{ $order->created_at }}
        </td>
        <td>
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.order',$order->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.order',$order->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
