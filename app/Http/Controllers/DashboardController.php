<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Kelompok;
use App\Models\Pinjaman;
use App\Models\TanggungRenteng;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard with statistics and recent activities.
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get statistics based on user role
        $statistics = $this->getStatistics($user);
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities($user);
        
        // Get notifications
        $notifications = $user->notifikasis()
            ->where('dibaca', false)
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('dashboard', [
            'statistics' => $statistics,
            'recentActivities' => $recentActivities,
            'notifications' => $notifications,
            'user' => $user->load('anggota.kelompok'),
        ]);
    }

    /**
     * Get statistics based on user role.
     *
     * @param  \App\Models\User  $user
     * @return array
     */
    protected function getStatistics($user)
    {
        if ($user->isAnggota()) {
            return $this->getAnggotaStatistics($user);
        } elseif ($user->isPetugas()) {
            return $this->getPetugasStatistics();
        } elseif ($user->isManager()) {
            return $this->getManagerStatistics();
        }

        return [];
    }

    /**
     * Get statistics for anggota.
     *
     * @param  \App\Models\User  $user
     * @return array
     */
    protected function getAnggotaStatistics($user)
    {
        $anggota = $user->anggota;
        
        if (!$anggota) {
            return [];
        }

        $pinjamanAktif = $anggota->pinjamen()->where('status', 'aktif')->count();
        $totalPinjaman = $anggota->pinjamen()->whereIn('status', ['aktif', 'lunas'])->sum('jumlah_pinjaman');
        $sisaPinjaman = $anggota->pinjamen()->where('status', 'aktif')->sum('jumlah_pinjaman');
        $angsuranTerlambat = Angsuran::whereHas('pinjaman', function ($query) use ($anggota) {
            $query->where('anggota_id', $anggota->id);
        })->terlambat()->count();

        return [
            'pinjaman_aktif' => $pinjamanAktif,
            'total_pinjaman' => $totalPinjaman,
            'sisa_pinjaman' => $sisaPinjaman,
            'angsuran_terlambat' => $angsuranTerlambat,
        ];
    }

    /**
     * Get statistics for petugas.
     *
     * @return array
     */
    protected function getPetugasStatistics()
    {
        return [
            'pengajuan_baru' => Pinjaman::where('status', 'pengajuan')->count(),
            'verifikasi_pending' => Pinjaman::where('status', 'verifikasi')->count(),
            'pinjaman_aktif' => Pinjaman::aktif()->count(),
            'angsuran_terlambat' => Angsuran::terlambat()->count(),
        ];
    }

    /**
     * Get statistics for manager.
     *
     * @return array
     */
    protected function getManagerStatistics()
    {
        return [
            'total_kelompok' => Kelompok::aktif()->count(),
            'total_anggota' => Anggota::aktif()->count(),
            'pinjaman_aktif' => Pinjaman::aktif()->count(),
            'total_piutang' => Pinjaman::aktif()->sum('jumlah_pinjaman'),
            'menunggu_persetujuan' => Pinjaman::where('status', 'disetujui')->count(),
            'tanggung_renteng_aktif' => TanggungRenteng::pending()->count(),
        ];
    }

    /**
     * Get recent activities based on user role.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    protected function getRecentActivities($user)
    {
        if ($user->isAnggota()) {
            return $this->getAnggotaActivities($user);
        } elseif ($user->isPetugas()) {
            return $this->getPetugasActivities();
        } elseif ($user->isManager()) {
            return $this->getManagerActivities();
        }

        return collect();
    }

    /**
     * Get recent activities for anggota.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    protected function getAnggotaActivities($user)
    {
        $anggota = $user->anggota;
        
        if (!$anggota) {
            return collect();
        }

        return $anggota->pinjamen()
            ->with(['kelompok', 'anggota'])
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get recent activities for petugas.
     *
     * @return mixed
     */
    protected function getPetugasActivities()
    {
        return Pinjaman::with(['kelompok', 'anggota'])
            ->whereIn('status', ['pengajuan', 'verifikasi'])
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get recent activities for manager.
     *
     * @return mixed
     */
    protected function getManagerActivities()
    {
        return Pinjaman::with(['kelompok', 'anggota'])
            ->latest()
            ->take(5)
            ->get();
    }
}