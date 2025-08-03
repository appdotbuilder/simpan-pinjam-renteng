import React from 'react';
import { Head, Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
        } | null;
    };
    [key: string]: unknown;
}

export default function Welcome({ auth }: Props) {
    return (
        <>
            <Head title="Selamat Datang - Sistem Pinjaman Kelompok" />
            
            <div className="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50">
                {/* Header */}
                <header className="bg-white shadow-sm border-b">
                    <div className="max-w-7xl mx-auto px-6 lg:px-8">
                        <div className="flex justify-between items-center py-6">
                            <div className="flex items-center space-x-4">
                                <div className="bg-blue-600 p-2 rounded-lg">
                                    <span className="text-white text-2xl">💰</span>
                                </div>
                                <div>
                                    <h1 className="text-2xl font-bold text-gray-900">LoanGroup</h1>
                                    <p className="text-sm text-gray-600">Sistem Administrasi Pinjaman Kelompok</p>
                                </div>
                            </div>
                            
                            <div className="flex items-center space-x-4">
                                {auth.user ? (
                                    <Link href="/dashboard">
                                        <Button>Dashboard</Button>
                                    </Link>
                                ) : (
                                    <div className="flex space-x-3">
                                        <Link href="/login">
                                            <Button variant="outline">Masuk</Button>
                                        </Link>
                                        <Link href="/register">
                                            <Button>Daftar</Button>
                                        </Link>
                                    </div>
                                )}
                            </div>
                        </div>
                    </div>
                </header>

                {/* Hero Section */}
                <section className="py-20 px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto text-center">
                        <div className="mb-8">
                            <h2 className="text-5xl font-bold text-gray-900 mb-6">
                                🏦 Sistem Administrasi Pinjaman Kelompok
                            </h2>
                            <p className="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                                Platform terpadu untuk mengelola pinjaman kelompok UMKM dengan sistem tanggung renteng, 
                                mulai dari pendaftaran hingga pelunasan dengan fitur monitoring dan pelaporan lengkap.
                            </p>
                        </div>

                        <div className="flex justify-center space-x-4 mb-16">
                            {!auth.user && (
                                <>
                                    <Link href="/register">
                                        <Button size="lg" className="px-8 py-3">
                                            🚀 Mulai Sekarang
                                        </Button>
                                    </Link>
                                    <Link href="/login">
                                        <Button variant="outline" size="lg" className="px-8 py-3">
                                            📱 Demo Login
                                        </Button>
                                    </Link>
                                </>
                            )}
                        </div>
                    </div>
                </section>

                {/* Features Grid */}
                <section className="py-16 px-6 lg:px-8 bg-white">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-16">
                            <h3 className="text-3xl font-bold text-gray-900 mb-4">
                                ✨ Fitur Utama Sistem
                            </h3>
                            <p className="text-lg text-gray-600">
                                Solusi lengkap untuk administrasi pinjaman kelompok
                            </p>
                        </div>

                        <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                            {/* Kelompok Management */}
                            <div className="bg-blue-50 p-8 rounded-xl border border-blue-100">
                                <div className="bg-blue-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">👥</span>
                                </div>
                                <h4 className="text-xl font-semibold text-gray-900 mb-3">
                                    Manajemen Kelompok
                                </h4>
                                <p className="text-gray-600 mb-4">
                                    Pendaftaran dan pengelolaan kelompok UMKM dengan data lengkap anggota dan struktur organisasi.
                                </p>
                                <ul className="text-sm text-gray-500 space-y-1">
                                    <li>• Pendaftaran kelompok baru</li>
                                    <li>• Manajemen data anggota</li>
                                    <li>• Tracking status kelompok</li>
                                </ul>
                            </div>

                            {/* Loan Processing */}
                            <div className="bg-green-50 p-8 rounded-xl border border-green-100">
                                <div className="bg-green-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">💳</span>
                                </div>
                                <h4 className="text-xl font-semibold text-gray-900 mb-3">
                                    Proses Pinjaman
                                </h4>
                                <p className="text-gray-600 mb-4">
                                    Alur lengkap pengajuan pinjaman dari submit hingga pencairan dengan sistem persetujuan bertingkat.
                                </p>
                                <ul className="text-sm text-gray-500 space-y-1">
                                    <li>• Pengajuan pinjaman digital</li>
                                    <li>• Verifikasi petugas</li>
                                    <li>• Persetujuan manajemen</li>
                                </ul>
                            </div>

                            {/* Tanggung Renteng */}
                            <div className="bg-orange-50 p-8 rounded-xl border border-orange-100">
                                <div className="bg-orange-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">🤝</span>
                                </div>
                                <h4 className="text-xl font-semibold text-gray-900 mb-3">
                                    Sistem Tanggung Renteng
                                </h4>
                                <p className="text-gray-600 mb-4">
                                    Fitur khusus untuk mengelola sistem tanggung renteng antar anggota kelompok dengan tracking kontribusi.
                                </p>
                                <ul className="text-sm text-gray-500 space-y-1">
                                    <li>• Auto distribusi tanggung jawab</li>
                                    <li>• Tracking kontribusi anggota</li>
                                    <li>• Notifikasi gagal bayar</li>
                                </ul>
                            </div>

                            {/* Payment Management */}
                            <div className="bg-purple-50 p-8 rounded-xl border border-purple-100">
                                <div className="bg-purple-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">💰</span>
                                </div>
                                <h4 className="text-xl font-semibold text-gray-900 mb-3">
                                    Manajemen Angsuran
                                </h4>
                                <p className="text-gray-600 mb-4">
                                    Sistem pembayaran angsuran dengan kalkulasi otomatis bunga, denda, dan jadwal pembayaran.
                                </p>
                                <ul className="text-sm text-gray-500 space-y-1">
                                    <li>• Jadwal angsuran otomatis</li>
                                    <li>• Kalkulasi bunga & denda</li>
                                    <li>• History pembayaran</li>
                                </ul>
                            </div>

                            {/* Notifications */}
                            <div className="bg-red-50 p-8 rounded-xl border border-red-100">
                                <div className="bg-red-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">🔔</span>
                                </div>
                                <h4 className="text-xl font-semibold text-gray-900 mb-3">
                                    Sistem Notifikasi
                                </h4>
                                <p className="text-gray-600 mb-4">
                                    Notifikasi real-time untuk semua aktivitas penting dalam sistem pinjaman kelompok.
                                </p>
                                <ul className="text-sm text-gray-500 space-y-1">
                                    <li>• Reminder jatuh tempo</li>
                                    <li>• Update status pinjaman</li>
                                    <li>• Alert sistem tanggung renteng</li>
                                </ul>
                            </div>

                            {/* Reports */}
                            <div className="bg-teal-50 p-8 rounded-xl border border-teal-100">
                                <div className="bg-teal-600 w-12 h-12 rounded-lg flex items-center justify-center mb-6">
                                    <span className="text-white text-2xl">📊</span>
                                </div>
                                <h4 className="text-xl font-semibold text-gray-900 mb-3">
                                    Laporan & Dokumen
                                </h4>
                                <p className="text-gray-600 mb-4">
                                    Laporan lengkap dan dokumen yang dapat dicetak untuk keperluan administrasi dan audit.
                                </p>
                                <ul className="text-sm text-gray-500 space-y-1">
                                    <li>• Laporan piutang & kolektabilitas</li>
                                    <li>• Surat perjanjian & persetujuan</li>
                                    <li>• Export PDF dokumen</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                {/* User Roles */}
                <section className="py-16 px-6 lg:px-8 bg-gray-50">
                    <div className="max-w-7xl mx-auto">
                        <div className="text-center mb-16">
                            <h3 className="text-3xl font-bold text-gray-900 mb-4">
                                👨‍💼 Peran Pengguna
                            </h3>
                            <p className="text-lg text-gray-600">
                                Sistem yang dirancang untuk berbagai peran dalam proses pinjaman
                            </p>
                        </div>

                        <div className="grid md:grid-cols-3 gap-8">
                            <div className="bg-white p-8 rounded-xl shadow-sm border">
                                <div className="text-center mb-6">
                                    <div className="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">👤</span>
                                    </div>
                                    <h4 className="text-xl font-semibold text-gray-900">Anggota UMKM</h4>
                                </div>
                                <ul className="space-y-3 text-gray-600">
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Mengajukan pinjaman
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Melihat status pinjaman
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Bayar angsuran
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        History pembayaran
                                    </li>
                                </ul>
                            </div>

                            <div className="bg-white p-8 rounded-xl shadow-sm border">
                                <div className="text-center mb-6">
                                    <div className="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">👨‍💻</span>
                                    </div>
                                    <h4 className="text-xl font-semibold text-gray-900">Petugas/Admin</h4>
                                </div>
                                <ul className="space-y-3 text-gray-600">
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Verifikasi pengajuan
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Survei lapangan
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Input pembayaran
                                    </li>  
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Generate dokumen
                                    </li>
                                </ul>
                            </div>

                            <div className="bg-white p-8 rounded-xl shadow-sm border">
                                <div className="text-center mb-6">
                                    <div className="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <span className="text-2xl">👨‍💼</span>
                                    </div>
                                    <h4 className="text-xl font-semibold text-gray-900">Manajer</h4>
                                </div>
                                <ul className="space-y-3 text-gray-600">
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Persetujuan pinjaman
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Dashboard eksekutif
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Laporan manajemen
                                    </li>
                                    <li className="flex items-center">
                                        <span className="text-green-500 mr-3">✓</span>
                                        Analisis risiko
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>

                {/* CTA Section */}
                <section className="py-20 px-6 lg:px-8 bg-blue-600">
                    <div className="max-w-4xl mx-auto text-center">
                        <h3 className="text-3xl font-bold text-white mb-6">
                            🚀 Siap Memulai Digitalisasi Pinjaman Kelompok?
                        </h3>
                        <p className="text-xl text-blue-100 mb-8">
                            Bergabunglah dengan platform modern untuk mengelola pinjaman kelompok UMKM
                            dengan sistem tanggung renteng yang efisien dan transparan.
                        </p>
                        
                        {!auth.user && (
                            <div className="flex justify-center space-x-4">
                                <Link href="/register">
                                    <Button size="lg" variant="outline" className="bg-white text-blue-600 hover:bg-blue-50 px-8 py-3">
                                        💼 Daftar Sebagai Petugas
                                    </Button>
                                </Link>
                                <Link href="/register">
                                    <Button size="lg" className="bg-blue-700 hover:bg-blue-800 px-8 py-3">
                                        👥 Daftar Kelompok UMKM
                                    </Button>
                                </Link>
                            </div>
                        )}
                    </div>
                </section>

                {/* Footer */}
                <footer className="bg-gray-900 text-white py-12 px-6 lg:px-8">
                    <div className="max-w-7xl mx-auto">
                        <div className="grid md:grid-cols-4 gap-8">
                            <div className="col-span-2">
                                <div className="flex items-center space-x-3 mb-4">
                                    <div className="bg-blue-600 p-2 rounded-lg">
                                        <span className="text-white text-xl">💰</span>
                                    </div>
                                    <div>
                                        <h4 className="text-xl font-bold">LoanGroup</h4>
                                        <p className="text-sm text-gray-400">Sistem Administrasi Pinjaman Kelompok</p>
                                    </div>
                                </div>
                                <p className="text-gray-400 mb-4">
                                    Platform terpercaya untuk mengelola pinjaman kelompok UMKM dengan 
                                    sistem tanggung renteng yang modern dan efisien.
                                </p>
                            </div>
                            
                            <div>
                                <h5 className="font-semibold mb-4">Fitur Utama</h5>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Manajemen Kelompok</li>
                                    <li>Proses Pinjaman</li>
                                    <li>Sistem Tanggung Renteng</li>
                                    <li>Laporan & Dokumen</li>
                                </ul>
                            </div>
                            
                            <div>
                                <h5 className="font-semibold mb-4">Pengguna</h5>
                                <ul className="space-y-2 text-gray-400">
                                    <li>Anggota UMKM</li>
                                    <li>Petugas/Admin</li>
                                    <li>Manajer</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div className="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                            <p>&copy; 2024 LoanGroup. Sistem Administrasi Pinjaman Kelompok UMKM.</p>
                        </div>
                    </div>
                </footer>
            </div>
        </>
    );
}