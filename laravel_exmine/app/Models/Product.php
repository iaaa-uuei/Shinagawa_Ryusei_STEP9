<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'description',
        'img_path',
    ];

    /**
     * 出品者
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 所属会社
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * 購入履歴
     */
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * お気に入り
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy(?int $userId): bool
    {
        if(!$userId) return false;
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public static function getIndexProducts(int $loginUserId): Collection
    {
        return self::query()
            ->where('user_id', '!=', $loginUserId)
            ->orderBy('id', 'asc')
            ->with(['company', 'user']) //一覧で会社名/出品者名を表示できる
            ->get();
    }   
}
