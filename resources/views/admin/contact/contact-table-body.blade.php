@php($i = 1)
@foreach ($contacts as $contact)
    <tr class="{{ $contact->status == 'unread' ? 'text-black' : 'text-secondary' }}">
        <td>{{ $i++ }}</td>
        <td>
            {{ $contact->name }}
        </td>
        <td>
            {{ $contact->email }}
        </td>
        <td>
            <a
                class="show-contact text-decoration-none {{ $contact->status == 'unread' ? 'text-black' : 'text-secondary' }}"
                href="javascript:void(0);"
                data-url="{{ route('panel.contact.show', $contact->id) }}"
            >
                {{ Str::limit($contact->message, 30, '...') }}
            </a>

        </td>
        <td>
                                                            <span class="contact-status"
                                                                  style="cursor: pointer;"
                                                                  data-id="{{ $contact->id }}">
                                                                {{ ucfirst($contact->status) }}
                                                            </span>
        </td>
        <td>
            <div class="d-flex order-actions justify-content-center">
                <a href="{{ route('panel.delete.contact',$contact->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
