
<div wire:poll.5000ms>
@foreach ($notification as $notif )

    <li >
        <a class="dropdown-item mb-3" href="{{ URL(''. $notif->link .'', $notif->id) }}">
            <img src=" @if ($notif->sender_image == NULL){{ URL('storage/doctor') }} @else {{ URL('storage/' . $notif->sender_type . 's/' . $notif->sender_id . '/' . $notif->sender_image)  }} @endif" class="me-2" height="30" alt="">
            <span>{{ $notif->notification }}</span>
        </a>
    </li>

@endforeach
</div>