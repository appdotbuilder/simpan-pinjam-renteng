<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Notifikasi
 *
 * @property int $id
 * @property int $user_id
 * @property string $judul
 * @property string $pesan
 * @property string $tipe
 * @property bool $dibaca
 * @property string|null $link
 * @property array|null $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereJudul($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi wherePesan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereTipe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereDibaca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notifikasi whereUpdatedAt($value)
 * @method static \Database\Factories\NotifikasiFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Notifikasi extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'judul',
        'pesan',
        'tipe',
        'dibaca',
        'link',
        'data',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dibaca' => 'boolean',
        'data' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notifikasi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get unread notifications.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBelumDibaca($query)
    {
        return $query->where('dibaca', false);
    }
}