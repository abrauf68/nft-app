@extends('frontend.layouts.share.master')

@section('title', 'Notifications')

@section('css')
<style>
/* Container */
.notifications-container {
    padding: 2rem 1rem;
    max-width: 800px;
    margin: 0 auto;
}

/* Card */
.notifications-card {
    background-color: #fefefe;
    border-radius: 1rem;
    padding: 2rem;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}

/* Header */
.notifications-header {
    display: flex;
    justify-content: flex-end;
    gap: 0.5rem;
    margin-bottom: 0px;
}

.notifications-header .btn {
    font-size: 1rem;
    padding: 0.5rem 0.6rem;
    border-radius: 0.5rem;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Header buttons colors */
.btn-read-all {
    background-color: #0077ff;
    color: #fff;
}

.btn-read-all:hover {
    background-color: #005fcc;
}

.btn-delete-all {
    background-color: #ff4d4f;
    color: #fff;
}

.btn-delete-all:hover {
    background-color: #cc3b3f;
}

/* Notification Item */
.notification-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background-color: #ffffff;
    padding: 1.2rem 1rem;
    border-radius: 0.75rem;
    border-left: 5px solid transparent;
    box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.notification-item.unread {
    border-left-color: #0077ff;
    background-color: #f0f7ff;
}

.notification-item.read {
    opacity: 0.7;
}

.notification-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

/* Notification content */
.notification-content {
    max-width: 75%;
}

.notification-content p.title {
    font-weight: 600;
    margin-bottom: 0.3rem;
    font-size: 0.9rem;
    color: #333;
}

.notification-content p.message {
    font-size: 0.7rem;
    color: #555;
}

/* New badge */
.notification-badge {
    background-color: #ffb100;
    color: #fff;
    font-size: 0.65rem;
    font-weight: 600;
    padding: 0.2rem 0.5rem;
    border-radius: 0.25rem;
    margin-bottom: 0.5rem;
    display: inline-block;
}

/* Action buttons */
.notification-actions {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.notification-actions a {
    font-size: 1.1rem;
    width: 25px;
    height: 25px;
    border-radius: 50%;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

/* Individual button colors */
.btn-read {
    background-color: #28a745;
    color: #fff;
}

.btn-read:hover {
    background-color: #218838;
}

.btn-delete {
    background-color: #dc3545;
    color: #fff;
}

.btn-delete:hover {
    background-color: #b02a37;
}
</style>
@endsection

@section('content')
<div class="notifications-container">
    <div class="notifications-card">
        <div class="notifications-list">
            @forelse($notifications as $notification)
            <div class="notification-item {{ $notification->read_at ? 'read' : 'unread' }}" data-id="{{ $notification->id }}">
                <div class="notification-content">
                    @if(!$notification->read_at)
                        <div class="notification-badge">New</div>
                    @endif
                    <p class="title">{{ $notification->title }}</p>
                    <p class="message">{{ $notification->message }}</p>
                </div>
                <div class="notification-actions">
                    @if(!$notification->read_at)
                        <a href="{{ route('frontend.notifications.markAsRead', $notification->id) }}" class="btn-read" title="Mark as Read">
                            <i class="ph ph-check"></i>
                        </a>
                    @endif
                    <a href="{{ route('frontend.notifications.delete', $notification->id) }}" class="btn-delete" title="Delete">
                        <i class="ph ph-trash"></i>
                    </a>
                </div>
            </div>
            @empty
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 2rem; color: #888;">
                    <i class="ph ph-bell-slash" style="font-size: 48px; margin-bottom: 1rem;"></i>
                    <p style="font-size: 16px; text-align: center; margin: 0;">No notifications found.</p>
                </div>
            @endforelse
        </div>
        @if (isset($notifications) && count($notifications) > 0)
            <div class="notifications-header">
                <a href="{{ route('frontend.notifications.markAllAsRead') }}" id="mark-all-read" class="btn btn-read-all" title="Mark All as Read">
                    <i class="ph ph-check-circle"></i>
                </a>
                <a href="{{ route('frontend.notifications.deleteAll') }}" id="delete-all" class="btn btn-delete-all" title="Delete All">
                    <i class="ph ph-trash"></i>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
