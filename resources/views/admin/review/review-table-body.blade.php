@php($i = 1)
@foreach ($reviews as $review)
    <tr>
        <td class="text-center">{{ $i++ }}</td>
        <td class="text-center">
            {{ $review->user->name }}
        </td>
        <td class="text-center">
            {{ Str::limit($review->product->title, 20, '...') }}
        </td>
        <td class="text-center">
            {{ Str::limit($review->comment, 30, '...') }}
        </td>
        <td class="text-center">
            {{ $review->rating }}
        </td>
        <td class="text-center">
                                                            <span class="review-status {{ $review->status == 'approved' ? 'text-black' : 'text-secondary' }}"
                                                                  style="cursor: pointer;"
                                                                  data-id="{{ $review->id }}">
                                                                {{ ucfirst($review->status) }}
                                                            </span>
        </td>
        <td class="text-center">
            <div class="d-flex order-actions justify-content-center"><a
                    href="{{ route('panel.edit.review',$review->id) }}"><i
                        class="bx bx-edit"></i></a>
                <a href="{{ route('panel.delete.review',$review->id) }}"
                   id="delete" class="ms-4"><i
                        class="bx bx-trash"></i></a>
            </div>
        </td>
    </tr>
@endforeach
