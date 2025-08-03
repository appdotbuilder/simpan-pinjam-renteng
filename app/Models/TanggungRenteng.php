<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\TanggungRenteng
 *
 * @property int $id
 * @property int $angsuran_id
 * @property int $anggota_penanggung_id
 * @property string $jumlah_tanggung
 * @property string $tanggal_tanggung
 * @property string $status
 * @property string|null $tanggal_kembali
 * @property string|null $keterangan
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Angsuran $angsuran
 * @property-read \App\Models\Anggota $anggotaPenanggung
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng query()
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereAngsuranId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereAnggotaPenanggungId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereJumlahTanggung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereTanggalTanggung($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereTanggalKembali($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereKeterangan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TanggungRenteng whereUpdatedAt($value)
 * @method static \Database\Factories\TanggungRentengFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class TanggungRenteng extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'angsuran_id',
        'anggota_penanggung_id',
        'jumlah_tanggung',
        'tanggal_tanggung',
        'status',
        'tanggal_kembali',
        'keterangan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_tanggung' => 'decimal:2',
        'tanggal_tanggung' => 'date',
        'tanggal_kembali' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the angsuran that owns the tanggung renteng.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function angsuran(): BelongsTo
    {
        return $this->belongsTo(Angsuran::class);
    }

    /**
     * Get the anggota penanggung.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anggotaPenanggung(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_penanggung_id');
    }

    /**
     * Scope to get pending tanggung renteng.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}