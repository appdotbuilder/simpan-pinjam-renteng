<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Pinjaman
 *
 * @property int $id
 * @property string $nomor_pinjaman
 * @property int $kelompok_id
 * @property int $anggota_id
 * @property string $jumlah_pinjaman
 * @property string $bunga_persen
 * @property int $tenor_bulan
 * @property string $angsuran_bulanan
 * @property string $tujuan_pinjaman
 * @property string|null $keterangan_tujuan
 * @property string $status
 * @property string|null $catatan_petugas
 * @property int|null $petugas_verifikasi_id
 * @property int|null $manager_persetujuan_id
 * @property string $tanggal_pengajuan
 * @property string|null $tanggal_verifikasi
 * @property string|null $tanggal_persetujuan
 * @property string|null $tanggal_pencairan
 * @property string|null $tanggal_jatuh_tempo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Kelompok $kelompok
 * @property-read \App\Models\Anggota $anggota
 * @property-read \App\Models\User|null $petugasVerifikasi
 * @property-read \App\Models\User|null $managerPersetujuan
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Angsuran> $angsurans
 * 
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman query()
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereNomorPinjaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereKelompokId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereAnggotaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereJumlahPinjaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereBungaPersen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTenorBulan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereAngsuranBulanan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTujuanPinjaman($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereKeteranganTujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereCatatanPetugas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman wherePetugasVerifikasiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereManagerPersetujuanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTanggalPengajuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTanggalVerifikasi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTanggalPersetujuan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTanggalPencairan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereTanggalJatuhTempo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Pinjaman whereUpdatedAt($value)
 * @method static \Database\Factories\PinjamanFactory factory($count = null, $state = [])
 * 
 * @mixin \Eloquent
 */
class Pinjaman extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nomor_pinjaman',
        'kelompok_id',
        'anggota_id',
        'jumlah_pinjaman',
        'bunga_persen',
        'tenor_bulan',
        'angsuran_bulanan',
        'tujuan_pinjaman',
        'keterangan_tujuan',
        'status',
        'catatan_petugas',
        'petugas_verifikasi_id',
        'manager_persetujuan_id',
        'tanggal_pengajuan',
        'tanggal_verifikasi',
        'tanggal_persetujuan',
        'tanggal_pencairan',
        'tanggal_jatuh_tempo',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'jumlah_pinjaman' => 'decimal:2',
        'bunga_persen' => 'decimal:2',
        'angsuran_bulanan' => 'decimal:2',
        'tanggal_pengajuan' => 'date',
        'tanggal_verifikasi' => 'date',
        'tanggal_persetujuan' => 'date',
        'tanggal_pencairan' => 'date',
        'tanggal_jatuh_tempo' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the kelompok that owns the pinjaman.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Kelompok::class);
    }

    /**
     * Get the anggota that owns the pinjaman.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }

    /**
     * Get the petugas verifikasi.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function petugasVerifikasi(): BelongsTo
    {
        return $this->belongsTo(User::class, 'petugas_verifikasi_id');
    }

    /**
     * Get the manager persetujuan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function managerPersetujuan(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_persetujuan_id');
    }

    /**
     * Get all angsurans for this pinjaman.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function angsurans(): HasMany
    {
        return $this->hasMany(Angsuran::class);
    }

    /**
     * Scope to get active pinjamen.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}