<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Anggota
 *
 * @property int $id
 * @property int $kelompok_id
 * @property string $nama_lengkap
 * @property string $nik
 * @property string $alamat
 * @property string $no_hp
 * @property string $jenis_usaha
 * @property string|null $omzet_bulanan
 * @property string $status
 * @property string $tanggal_bergabung
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kelompok $kelompok
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pinjaman> $pinjamen
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\TanggungRenteng> $tanggungRentengs
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota query()
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereKelompokId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereNamaLengkap($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereNik($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereNoHp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereJenisUsaha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereOmzetBulanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereTanggalBergabung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Anggota whereUpdatedAt($value)
 * @method static \Database\Factories\AnggotaFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Anggota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'kelompok_id',
        'nama_lengkap',
        'nik',
        'alamat',
        'no_hp',
        'jenis_usaha',
        'omzet_bulanan',
        'status',
        'tanggal_bergabung',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'omzet_bulanan' => 'decimal:2',
        'tanggal_bergabung' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the kelompok that owns the anggota.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Kelompok::class);
    }

    /**
     * Get all pinjamen for this anggota.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pinjamen(): HasMany
    {
        return $this->hasMany(Pinjaman::class);
    }

    /**
     * Get the user account for this anggota.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * Get all tanggung renteng records for this anggota.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tanggungRentengs(): HasMany
    {
        return $this->hasMany(TanggungRenteng::class, 'anggota_penanggung_id');
    }

    /**
     * Scope to get active anggotas.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}