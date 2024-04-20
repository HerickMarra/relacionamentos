<link rel="stylesheet" href="{{ asset("components/emotion/emotion-item.css?v=$version") }}">

<div class="x-emotion-item">
    <div class="x-emotion-item-profile">
        <div style="background-image: url({{$image}})" class="x-emotion-item-profile-image"></div>
    </div>

    <div class="x-emotion-item-desc">
        <p class="x-emotion-item-desc-title">{{strlen($emotion->description) >74 ? substr($emotion->description, 0,74) . "..." : $emotion->description}}</p>
        <p class="x-emotion-item-desc-level" >{{$emotion->level}}/10  -- <span>{{date("d/m/Y H:i:s", strtotime($emotion->created_at))}}</span></p>
    </div>

    <div class="x-emotion-item-icons">
        @if ($emotion->emotion == 'serious')
            <i style="color: #FC1A1A;" class="bi bi-exclamation-octagon-fill"></i>

        @elseif ($emotion->emotion == 'happy')
            <i style="color: #3BB900;" class="bi bi-emoji-heart-eyes-fill"></i>
        @elseif ($emotion->emotion == 'alert')
            <i style="color: #FFB800;" class="bi bi-exclamation-triangle-fill"></i>
        @endif
    </div>
</div>
