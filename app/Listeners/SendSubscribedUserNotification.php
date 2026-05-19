<?php

namespace App\Listeners;

use App\Filament\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Kirschbaum\Commentions\Events\UserIsSubscribedToCommentableEvent;

class SendSubscribedUserNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(UserIsSubscribedToCommentableEvent $event): void
    {
        $author = User::find($event->comment->author_id);
        $recip = User::find($event->user->id);
        $task = Order::find($event->comment->commentable_id);
        Notification::make()
            ->title($author->name . ' ha commentato l\'Ordine '.$task->product->code .' con data ' . $task->date)
            ->body($event->comment->body)
            ->actions([
                Action::make('Visualizza')
                    ->url(OrderResource::getUrl('edit', ['record' => $task])),
            ])
            ->sendToDatabase($recip);
    }
}
