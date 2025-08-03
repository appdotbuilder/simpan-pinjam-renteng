<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Kelompok
 *
 * @property int $id
 * @property string $nama_kelompok
 * @property string $alamat
 * @property string $ketua_kelompok
 * @property string $kontak_ketua
 * @property string $status
 * @property string|null $keterangan
 * @property string $tanggal_daftar
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Anggota> $anggotas
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Pinjaman> $pinjamen
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok query()
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereNamaKelompok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereAlamat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereKetuaKelompok($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereKontakKetua($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereTanggalDaftar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Kelompok whereUpdatedAt($value)
 * @method static \Database\Factories\KelompokFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Kelompok extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nama_kelompok',
        'alamat',
        'ketua_kelompok',
        'kontak_ketua',
        'status',
        'keterangan',
        'tanggal_daftar',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal_daftar' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get all anggotas for this kelompok.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function anggotas(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    /**
     * Get all pinjamen for this kelompok.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pinjamen(): HasMany
    {
        return $this->hasMany(Pinjaman::class);
    }

    /**
     * Scope to get active kelompoks.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}