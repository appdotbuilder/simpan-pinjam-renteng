<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Angsuran
 *
 * @property int $id
 * @property int $pinjaman_id
 * @property int $angsuran_ke
 * @property string $jumlah_angsuran
 * @property string $pokok
 * @property string $bunga
 * @property string $tanggal_jatuh_tempo
 * @property string|null $tanggal_bayar
 * @property string $jumlah_dibayar
 * @property string $status
 * @property int $hari_terlambat
 * @property string $denda
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pinjaman $pinjaman
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TanggungRenteng> $tanggungRentengs
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran query()
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran wherePinjamanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereAngsuranKe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereJumlahAngsuran($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran wherePokok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereBunga($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereTanggalJatuhTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereTanggalBayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereJumlahDibayar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereHariTerlambat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereDenda($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Angsuran whereUpdatedAt($value)
 * @method static \Database\Factories\AngsuranFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Angsuran extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'pinjaman_id',
        'angsuran_ke',
        'jumlah_angsuran',
        'pokok',
        'bunga',
        'tanggal_jatuh_tempo',
        'tanggal_bayar',
        'jumlah_dibayar',
        'status',
        'hari_terlambat',
        'denda',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_angsuran' => 'decimal:2',
        'pokok' => 'decimal:2',
        'bunga' => 'decimal:2',
        'jumlah_dibayar' => 'decimal:2',
        'denda' => 'decimal:2',
        'tanggal_jatuh_tempo' => 'date',
        'tanggal_bayar' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the pinjaman that owns the angsuran.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pinjaman(): BelongsTo
    {
        return $this->belongsTo(Pinjaman::class);
    }

    /**
     * Get all tanggung renteng records for this angsuran.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tanggungRentengs(): HasMany
    {
        return $this->hasMany(TanggungRenteng::class);
    }

    /**
     * Scope to get overdue angsurans.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeTerlambat($query)
    {
        return $query->where('status', 'terlambat');
    }
}