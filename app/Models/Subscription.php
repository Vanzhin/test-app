<?php

namespace App\Models;

use App\Mail\SendSubscriptionMail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;


class Subscription extends BaseModel
{
    use HasFactory;
    protected  $table = 'subscriptions';
    protected $fillable = [
        'user_id',
        'email',
        'subject',
        'subject_type',
        'status',
    ];

    public function scopeActiveBySubject(string $subject_type, string $subject)
    {
        return self::query()->where(['subject_type' => $subject_type,'subject' => $subject, 'status' => 1])
            ->get();
    }
    public static function sendEmailBySubscription(News $news)
    {
        //todo убрать создание модели
        $subscriptions = (new Subscription)->scopeActiveBySubject('author' ,$news->author);
        foreach($subscriptions as $subscription){

            Mail::to($subscription->email)->send(new SendSubscriptionMail($news));

        };
    }

}
