<li class="nav-item dropdown" style="list-style: none;">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($unreadNotifications)
        <span class="badge badge-warning navbar-badge">{{ $unreadNotifications }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">{{ $unreadNotifications }} New Notifications</span>
        <div class="dropdown-divider"></div>
        @foreach ($notifications as $notification)
        <form action="{{route('mark-as-read', $notification->id)}}" method="POST" id="notification">
            @csrf
            @method('PUT')
            <button type="submit" id="showDivBtn" class="dropdown-item @if ($notification->unread())
            text-info @endif">
                <i class="fas fa-envelope mr-2"></i> {{ Str::limit($notification->data['header'] ?? false, 20, '...') }}
                <span class="float-right text-muted text-sm">{{ $notification->created_at->longAbsoluteDiffForHumans() }}</span>
            </button>
        </form>
        <div class="dropdown-divider"></div>
        @endforeach
        @if($unreadNotifications)
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        @endif
    </div>
</li>