<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kirschbaum\Commentions\Contracts\Commentable;
use Kirschbaum\Commentions\HasComments;

class Order extends Model implements Commentable
{
    use HasComments;
    
    protected $guarded = [
        'id'
    ];

    // protected $dates = [
    //     'date'
    // ];

    protected function casts(): array
    {
        return [
            'state' => OrderStatus::class,
        ];
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
