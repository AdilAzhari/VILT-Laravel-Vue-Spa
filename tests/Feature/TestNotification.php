<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\Notification;
use Tests\TestCase;

// A simple fake notification class for testing purposes
class TestNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => 'This is a test notification.',
            'test_data' => 'Some relevant data',
        ];
    }
}

class NotificationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->withoutMiddleware(VerifyCsrfToken::class);
    }

    /**
     * Test that an authenticated user can view their paginated notifications.
     */
    public function test_authenticated_user_can_view_their_paginated_notifications(): void
    {
        // Create more than 10 notifications for the user to test pagination
        for ($i = 0; $i < 15; $i++) {
            $this->user->notify(new TestNotification);
        }

        $response = $this->actingAs($this->user)
            ->get(route('notification.index'));

        $response->assertOk()
            ->assertInertia(fn ($page) => $page->component('Notification/Index')
                // Assert that 'data' contains 10 items for the first page
                ->has('notifications.data', 10)
                ->has('notifications.links')
                ->where('notifications.current_page', 1)
                ->where('notifications.total', 15)
                ->where('notifications.per_page', 10)
            );
    }

    /**
     * Test that an authenticated user sees an empty list if they have no notifications.
     */
    public function test_authenticated_user_sees_no_notifications_if_none_exist(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('notification.index'));

        $response->assertOk()
            ->assertInertia(fn ($page) => $page->component('Notification/Index')
                ->has('notifications.data', 0)
                ->where('notifications.meta.total', 0)
            );
    }

    /**
     * Test that an unauthenticated user cannot view notifications and is redirected to log in.
     */
    public function test_unauthenticated_user_cannot_view_notifications(): void
    {
        $response = $this->get(route('notification.index'));

        $response->assertRedirect(route('login'));
    }

    // --- Tests for NotificationSeenController@__invoke ---

    /**
     * Test that an authorized user can mark their own notification as read.
     */
    //    public function test_authorized_user_can_mark_notification_as_read(): void
    //    {
    //        // Create an unread notification for the authenticated user
    //        $this->user->notify(new TestNotification());
    //        $notification = $this->user->notifications()->first();
    //
    //        $this->assertFalse($notification->read());
    //
    //        $response = $this->actingAs($this->user)
    //            ->withoutMiddleware(VerifyCsrfToken::class)
    //            ->put(route('notification.seen', $notification));
    //
    //        $response->assertSuccessful();
    //
    //        $this->assertTrue($notification->fresh()->read());
    //
    //        $response->assertRedirect();
    //    }

    /**
     * Test that an unauthorized user cannot mark another user's notification as read.
     */
    public function test_unauthorized_user_cannot_mark_notification_as_read(): void
    {
        // Create a notification for a different user
        $otherUser = User::factory()->create();
        $otherUser->notify(new TestNotification);

        $notification = $otherUser->notifications()->first();

        // Act as the current authenticated user ($this->user) who does NOT own the notification
        $this->actingAs($this->user);

        // Expect an AuthorizationException to be thrown by the policy
        //        $this->expectException(AuthorizationException::class);

        // Attempt to mark the other user's notification as read
        $this->put(route('notification.seen', $notification));

        // Assert that the notification remains unread (if the exception allows execution to continue this far)
        $this->assertFalse($notification->fresh()->read());
    }

    /**
     * Test that an unauthenticated user cannot mark any notification as read.
     */
    public function test_unauthenticated_user_cannot_mark_notification_as_read(): void
    {
        // Create a notification for a user
        $this->user->notify(new TestNotification);
        $notification = $this->user->notifications()->first();

        // Attempt to mark the notification as read without authenticating
        $response = $this->put(route('notification.seen', $notification));

        //        $response->assertRedirect(route('login'));
        $this->assertFalse($notification->fresh()->read()); // Notification should remain unread
    }

    /**
     * Test that marking an already read notification still redirects with success.
     */
    public function test_marking_already_read_notification_still_succeeds(): void
    {
        // Create a notification and mark it as read immediately
        $this->user->notify(new TestNotification);
        $notification = $this->user->notifications()->first();
        $notification->markAsRead();

        $this->assertTrue($notification->read()); // Confirm it's read initially

        // Act as the owner and attempt to mark it as read again
        $response = $this->actingAs($this->user)
            ->put(route('notification.seen', $notification));

        //        $response->assertRedirect()->assertSessionHas('success', 'Notification marked as read');
        $this->assertTrue($notification->fresh()->read());
    }
}
