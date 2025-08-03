import React from 'react';
import { Head, Link, router } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';

interface Kelompok {
    id: number;
    nama_kelompok: string;
    alamat: string;
    ketua_kelompok: string;
    kontak_ketua: string;
    status: 'aktif' | 'tidak_aktif' | 'pending';
    tanggal_daftar: string;
    anggotas_count: number;
}

interface Props {
    kelompoks: {
        data: Kelompok[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        meta: {
            current_page: number;
            last_page: number;
            from: number;
            to: number;
            total: number;
        };
    };
    filters: {
        status?: string;
        search?: string;
    };
    [key: string]: unknown;
}

export default function KelompokIndex({ kelompoks, filters }: Props) {
    const getStatusColor = (status: string) => {
        switch (status) {
            case 'aktif': return 'bg-green-100 text-green-800';
            case 'tidak_aktif': return 'bg-red-100 text-red-800';
            case 'pending': return 'bg-yellow-100 text-yellow-800';
            default: return 'bg-gray-100 text-gray-800';
        }
    };

    const handleSearch = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        const formData = new FormData(e.currentTarget);
        const search = formData.get('search') as string;
        
        router.get(route('kelompok.index'), {
            search: search || undefined,
            status: filters.status || undefined,
        }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    const handleStatusFilter = (status: string | null) => {
        router.get(route('kelompok.index'), {
            search: filters.search || undefined,
            status: status || undefined,
        }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    return (
        <AppShell>
            <Head title="Daftar Kelompok - Sistem Pinjaman Kelompok" />
            
            <div className="p-6">
                {/* Header */}
                <div className="flex justify-between items-center mb-8">
                    <div>
                        <h1 className="text-3xl font-bold text-gray-900 mb-2">
                            👥 Daftar Kelompok
                        </h1>
                        <p className="text-gray-600">
                            Kelola dan pantau kelompok UMKM yang terdaftar
                        </p>
                    </div>
                    <Link href={route('kelompok.create')}>
                        <Button>
                            ➕ Daftar Kelompok Baru
                        </Button>
                    </Link>
                </div>

                {/* Filters */}
                <div className="bg-white rounded-lg shadow-sm border mb-6">
                    <div className="p-6">
                        <div className="flex flex-col md:flex-row gap-4">
                            {/* Search */}
                            <form onSubmit={handleSearch} className="flex-1">
                                <div className="flex gap-2">
                                    <input
                                        type="text"
                                        name="search"
                                        placeholder="Cari nama kelompok atau ketua..."
                                        defaultValue={filters.search || ''}
                                        className="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                    />
                                    <Button type="submit" variant="outline">
                                        🔍 Cari
                                    </Button>
                                </div>
                            </form>
                            
                            {/* Status Filter */}
                            <div className="flex gap-2">
                                <Button 
                                    variant={!filters.status ? "default" : "outline"}
                                    onClick={() => handleStatusFilter(null)}
                                    size="sm"
                                >
                                    Semua
                                </Button>
                                <Button 
                                    variant={filters.status === 'aktif' ? "default" : "outline"}
                                    onClick={() => handleStatusFilter('aktif')}
                                    size="sm"
                                >
                                    Aktif
                                </Button>
                                <Button 
                                    variant={filters.status === 'pending' ? "default" : "outline"}
                                    onClick={() => handleStatusFilter('pending')}
                                    size="sm"
                                >
                                    Pending
                                </Button>
                                <Button 
                                    variant={filters.status === 'tidak_aktif' ? "default" : "outline"}
                                    onClick={() => handleStatusFilter('tidak_aktif')}
                                    size="sm"
                                >
                                    Tidak Aktif
                                </Button>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Kelompok List */}
                <div className="bg-white rounded-lg shadow-sm border">
                    {kelompoks.data.length > 0 ? (
                        <>
                            <div className="overflow-x-auto">
                                <table className="w-full">
                                    <thead className="bg-gray-50 border-b">
                                        <tr>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Kelompok
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Ketua
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Anggota
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Tanggal Daftar
                                            </th>
                                            <th className="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody className="bg-white divide-y divide-gray-200">
                                        {kelompoks.data.map((kelompok) => (
                                            <tr key={kelompok.id} className="hover:bg-gray-50">
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div>
                                                        <div className="text-sm font-medium text-gray-900">
                                                            {kelompok.nama_kelompok}
                                                        </div>
                                                        <div className="text-sm text-gray-500 truncate max-w-xs">
                                                            {kelompok.alamat}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div>
                                                        <div className="text-sm font-medium text-gray-900">
                                                            {kelompok.ketua_kelompok}
                                                        </div>
                                                        <div className="text-sm text-gray-500">
                                                            {kelompok.kontak_ketua}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <div className="flex items-center">
                                                        <span className="text-2xl mr-2">👥</span>
                                                        <span className="text-sm font-medium text-gray-900">
                                                            {kelompok.anggotas_count} orang
                                                        </span>
                                                    </div>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap">
                                                    <span className={`px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${getStatusColor(kelompok.status)}`}>
                                                        {kelompok.status}
                                                    </span>
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                    {new Date(kelompok.tanggal_daftar).toLocaleDateString('id-ID')}
                                                </td>
                                                <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <div className="flex justify-end gap-2">
                                                        <Link href={route('kelompok.show', kelompok.id)}>
                                                            <Button variant="outline" size="sm">
                                                                👁️ Lihat
                                                            </Button>
                                                        </Link>
                                                        <Link href={route('kelompok.edit', kelompok.id)}>
                                                            <Button variant="outline" size="sm">
                                                                ✏️ Edit
                                                            </Button>
                                                        </Link>
                                                    </div>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                            
                            {/* Pagination would go here */}
                            {kelompoks.meta && kelompoks.meta.last_page > 1 && (
                                <div className="px-6 py-3 border-t bg-gray-50">
                                    <div className="flex items-center justify-between">
                                        <div className="text-sm text-gray-700">
                                            Menampilkan {kelompoks.meta.from} - {kelompoks.meta.to} dari {kelompoks.meta.total} kelompok
                                        </div>
                                        {/* Pagination links would be rendered here */}
                                    </div>
                                </div>
                            )}
                        </>
                    ) : (
                        <div className="text-center py-12">
                            <span className="text-6xl mb-4 block">📋</span>
                            <h3 className="text-lg font-medium text-gray-900 mb-2">
                                Belum Ada Kelompok
                            </h3>
                            <p className="text-gray-500 mb-6">
                                Belum ada kelompok UMKM yang terdaftar dalam sistem.
                            </p>
                            <Link href={route('kelompok.create')}>
                                <Button>
                                    ➕ Daftar Kelompok Pertama
                                </Button>
                            </Link>
                        </div>
                    )}
                </div>
            </div>
        </AppShell>
    );
}