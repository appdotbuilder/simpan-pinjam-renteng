import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';

interface Statistics {
    pinjaman_aktif?: number;
    total_pinjaman?: number;
    sisa_pinjaman?: number;
    angsuran_terlambat?: number;
    pengajuan_baru?: number;
    verifikasi_pending?: number;
    total_kelompok?: number;
    total_anggota?: number;
    total_piutang?: number;
    menunggu_persetujuan?: number;
    tanggung_renteng_aktif?: number;
}

interface User {
    id: number;
    name: string;
    email: string;
    role: 'anggota' | 'petugas' | 'manager';
    anggota?: {
        id: number;
        nama_lengkap: string;
        kelompok: {
            id: number;
            nama_kelompok: string;
        };
    };
}

interface Notification {
    id: number;
    judul: string;
    pesan: string;
    tipe: 'info' | 'warning' | 'success' | 'error';
    created_at: string;
}

interface RecentActivity {
    id: number;
    nomor_pinjaman?: string;
    status: string;
    jumlah_pinjaman?: number;
    tanggal_pengajuan?: string;
    anggota?: {
        nama_lengkap: string;
    };
    kelompok?: {
        nama_kelompok: string;
    };
}

interface Props {
    statistics: Statistics;
    recentActivities: RecentActivity[];
    notifications: Notification[];
    user: User;
    [key: string]: unknown;
}

export default function Dashboard({ statistics, recentActivities, notifications, user }: Props) {
    const formatCurrency = (amount: number) => {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(amount);
    };

    const getStatusColor = (status: string) => {
        switch (status) {
            case 'pengajuan': return 'bg-yellow-100 text-yellow-800';
            case 'verifikasi': return 'bg-blue-100 text-blue-800';
            case 'disetujui': return 'bg-green-100 text-green-800';
            case 'ditolak': return 'bg-red-100 text-red-800';
            case 'dicairkan': return 'bg-purple-100 text-purple-800';
            case 'aktif': return 'bg-green-100 text-green-800';
            case 'lunas': return 'bg-gray-100 text-gray-800';
            case 'macet': return 'bg-red-100 text-red-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    };

    const getNotificationColor = (tipe: string) => {
        switch (tipe) {
            case 'success': return 'bg-green-50 border-green-200 text-green-800';
            case 'warning': return 'bg-yellow-50 border-yellow-200 text-yellow-800';
            case 'error': return 'bg-red-50 border-red-200 text-red-800';
            default: return 'bg-blue-50 border-blue-200 text-blue-800';
        }
    };

    const renderStatistics = () => {
        if (user.role === 'anggota') {
            return (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-blue-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">💳</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Pinjaman Aktif</p>
                                <p className="text-2xl font-bold text-gray-900">{statistics.pinjaman_aktif || 0}</p>
                            </div>
                        </div>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-green-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">💰</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Total Pinjaman</p>
                                <p className="text-2xl font-bold text-gray-900">{formatCurrency(statistics.total_pinjaman || 0)}</p>
                            </div>
                        </div>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-orange-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">⏰</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Sisa Pinjaman</p>
                                <p className="text-2xl font-bold text-gray-900">{formatCurrency(statistics.sisa_pinjaman || 0)}</p>
                            </div>
                        </div>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-red-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">⚠️</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Angsuran Terlambat</p>
                                <p className="text-2xl font-bold text-gray-900">{statistics.angsuran_terlambat || 0}</p>
                            </div>
                        </div>
                    </div>
                </div>
            );
        } else if (user.role === 'petugas') {
            return (
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-yellow-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">📝</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Pengajuan Baru</p>
                                <p className="text-2xl font-bold text-gray-900">{statistics.pengajuan_baru || 0}</p>
                            </div>
                        </div>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-blue-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">🔍</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Perlu Verifikasi</p>
                                <p className="text-2xl font-bold text-gray-900">{statistics.verifikasi_pending || 0}</p>
                            </div>
                        </div>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-green-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">✅</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Pinjaman Aktif</p>
                                <p className="text-2xl font-bold text-gray-900">{statistics.pinjaman_aktif || 0}</p>
                            </div>
                        </div>
                    </div>
                    <div className="bg-white p-6 rounded-lg shadow-sm border">
                        <div className="flex items-center">
                            <div className="bg-red-100 p-3 rounded-lg mr-4">
                                <span className="text-2xl">⚠️</span>
                            </div>
                            <div>
                                <p className="text-sm text-gray-600">Terlambat</p>
                                <p className="text-2xl font-bold text-gray-900">{statistics.angsuran_terlambat || 0}</p>
                            </div>
                        </div>
                    </div>
                </div>
            );
        } else if (user.role === 'manager') {
            return (
                <>
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div className="bg-white p-6 rounded-lg shadow-sm border">
                            <div className="flex items-center">
                                <div className="bg-blue-100 p-3 rounded-lg mr-4">
                                    <span className="text-2xl">👥</span>
                                </div>
                                <div>
                                    <p className="text-sm text-gray-600">Total Kelompok</p>
                                    <p className="text-2xl font-bold text-gray-900">{statistics.total_kelompok || 0}</p>
                                </div>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm border">
                            <div className="flex items-center">
                                <div className="bg-green-100 p-3 rounded-lg mr-4">
                                    <span className="text-2xl">👤</span>
                                </div>
                                <div>
                                    <p className="text-sm text-gray-600">Total Anggota</p>
                                    <p className="text-2xl font-bold text-gray-900">{statistics.total_anggota || 0}</p>
                                </div>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm border">
                            <div className="flex items-center">
                                <div className="bg-purple-100 p-3 rounded-lg mr-4">
                                    <span className="text-2xl">💰</span>
                                </div>
                                <div>
                                    <p className="text-sm text-gray-600">Total Piutang</p>
                                    <p className="text-xl font-bold text-gray-900">{formatCurrency(statistics.total_piutang || 0)}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div className="bg-white p-6 rounded-lg shadow-sm border">
                            <div className="flex items-center">
                                <div className="bg-yellow-100 p-3 rounded-lg mr-4">
                                    <span className="text-2xl">⏳</span>
                                </div>
                                <div>
                                    <p className="text-sm text-gray-600">Menunggu Persetujuan</p>
                                    <p className="text-2xl font-bold text-gray-900">{statistics.menunggu_persetujuan || 0}</p>
                                </div>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm border">
                            <div className="flex items-center">
                                <div className="bg-orange-100 p-3 rounded-lg mr-4">
                                    <span className="text-2xl">🤝</span>
                                </div>
                                <div>
                                    <p className="text-sm text-gray-600">Tanggung Renteng Aktif</p>
                                    <p className="text-2xl font-bold text-gray-900">{statistics.tanggung_renteng_aktif || 0}</p>
                                </div>
                            </div>
                        </div>
                        <div className="bg-white p-6 rounded-lg shadow-sm border">
                            <div className="flex items-center">
                                <div className="bg-green-100 p-3 rounded-lg mr-4">
                                    <span className="text-2xl">✅</span>
                                </div>
                                <div>
                                    <p className="text-sm text-gray-600">Pinjaman Aktif</p>
                                    <p className="text-2xl font-bold text-gray-900">{statistics.pinjaman_aktif || 0}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </>
            );
        }
        return null;
    };

    return (
        <AppShell>
            <Head title="Dashboard - Sistem Pinjaman Kelompok" />
            
            <div className="p-6">
                {/* Header */}
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-900 mb-2">
                        🏠 Dashboard
                    </h1>
                    <p className="text-gray-600">
                        Selamat datang, {user.name}! 
                        {user.role === 'anggota' && user.anggota ? 
                            ` (${user.anggota.kelompok.nama_kelompok})` : 
                            ` (${user.role.charAt(0).toUpperCase() + user.role.slice(1)})`
                        }
                    </p>
                </div>

                {/* Statistics */}
                {renderStatistics()}

                <div className="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    {/* Recent Activities */}
                    <div className="bg-white rounded-lg shadow-sm border">
                        <div className="p-6 border-b">
                            <h2 className="text-xl font-semibold text-gray-900 flex items-center">
                                📊 Aktivitas Terbaru
                            </h2>
                        </div>
                        <div className="p-6">
                            {recentActivities && recentActivities.length > 0 ? (
                                <div className="space-y-4">
                                    {recentActivities.slice(0, 5).map((activity) => (
                                        <div key={activity.id} className="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                            <div className="flex-1">
                                                <p className="font-medium text-gray-900">
                                                    {activity.nomor_pinjaman || `Pinjaman #${activity.id}`}
                                                </p>
                                                <p className="text-sm text-gray-600">
                                                    {activity.anggota?.nama_lengkap} - {activity.kelompok?.nama_kelompok}
                                                </p>
                                                <p className="text-sm text-gray-500">
                                                    {activity.jumlah_pinjaman ? formatCurrency(activity.jumlah_pinjaman) : ''}
                                                </p>
                                            </div>
                                            <div className="ml-4">
                                                <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusColor(activity.status)}`}>
                                                    {activity.status}
                                                </span>
                                                <p className="text-xs text-gray-500 mt-1">
                                                    {activity.tanggal_pengajuan ? new Date(activity.tanggal_pengajuan).toLocaleDateString('id-ID') : ''}
                                                </p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">📋</span>
                                    Belum ada aktivitas terbaru
                                </div>
                            )}
                        </div>
                    </div>

                    {/* Notifications */}
                    <div className="bg-white rounded-lg shadow-sm border">
                        <div className="p-6 border-b">
                            <h2 className="text-xl font-semibold text-gray-900 flex items-center">
                                🔔 Notifikasi
                            </h2>
                        </div>
                        <div className="p-6">
                            {notifications && notifications.length > 0 ? (
                                <div className="space-y-4">
                                    {notifications.slice(0, 5).map((notification) => (
                                        <div key={notification.id} className={`p-4 rounded-lg border ${getNotificationColor(notification.tipe)}`}>
                                            <h4 className="font-medium mb-1">{notification.judul}</h4>
                                            <p className="text-sm mb-2">{notification.pesan}</p>
                                            <p className="text-xs opacity-75">
                                                {new Date(notification.created_at).toLocaleString('id-ID')}
                                            </p>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div className="text-center py-8 text-gray-500">
                                    <span className="text-4xl mb-2 block">🔕</span>
                                    Tidak ada notifikasi baru
                                </div>
                            )}
                        </div>
                    </div>
                </div>

                {/* Quick Actions */}
                <div className="mt-8 bg-white rounded-lg shadow-sm border">
                    <div className="p-6 border-b">
                        <h2 className="text-xl font-semibold text-gray-900">⚡ Aksi Cepat</h2>
                    </div>
                    <div className="p-6">
                        <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
                            {user.role === 'anggota' && (
                                <>
                                    <Button className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">💳</span>
                                        <span className="text-sm">Ajukan Pinjaman</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">💰</span>
                                        <span className="text-sm">Bayar Angsuran</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">📊</span>
                                        <span className="text-sm">History Pembayaran</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">👥</span>
                                        <span className="text-sm">Info Kelompok</span>
                                    </Button>
                                </>
                            )}
                            
                            {user.role === 'petugas' && (
                                <>
                                    <Button className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">🔍</span>
                                        <span className="text-sm">Verifikasi Pinjaman</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">👥</span>
                                        <span className="text-sm">Daftar Kelompok</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">📝</span>
                                        <span className="text-sm">Input Pembayaran</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">📄</span>
                                        <span className="text-sm">Generate Dokumen</span>
                                    </Button>
                                </>
                            )}
                            
                            {user.role === 'manager' && (
                                <>
                                    <Button className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">✅</span>
                                        <span className="text-sm">Persetujuan Pinjaman</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">📊</span>
                                        <span className="text-sm">Laporan Piutang</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">📈</span>
                                        <span className="text-sm">Analisis Risiko</span>
                                    </Button>
                                    <Button variant="outline" className="h-auto p-4 flex flex-col items-center space-y-2">
                                        <span className="text-2xl">🏦</span>
                                        <span className="text-sm">Dashboard Manajemen</span>
                                    </Button>
                                </>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AppShell>
    );
}