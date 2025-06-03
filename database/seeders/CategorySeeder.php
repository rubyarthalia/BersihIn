<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 'C01',
                'nama' => 'Cleaning',
                'deskripsi' => 'Kami memastikan rumah Anda selalu bersih, rapi dan nyaman dengan layanan permbersihan setiap sudut rumah Anda dari ruangan, sofa, kasur, kamar mandi, dapur, hingga taman',
                'gambar' => 'kategori-cleaning', 
                'created_at' => now(),
                'updated_at' => null,
                'status_del' => 0,
            ],
            [
                'id' => 'C02',
                'nama' => 'Laundry',
                'deskripsi' => 'Kami akan menyetrika, dan merapikan pakaian Anda, dengan hasil yang rapi dan higienis. Kami juga menawarkan layanan pembersihan untuk tas.',
                'gambar' => 'kategori-laundry', 
                'created_at' => now(),
                'updated_at' => null,
                'status_del' => 0,
            ],
            [
                'id' => 'C03',
                'nama' => 'Maintenance',
                'deskripsi' => 'Kami menjaga fungsi dan kenyamanan rumah Anda melalui berbagai layanan perbaikan dan perawatan untuk peralatan di rumah, mulai dari AC hingga perbaikan pipa.',
                'gambar' => 'kategori-maintenance', 
                'created_at' => now(),
                'updated_at' => null,
                'status_del' => 0,
            ],
            [
                'id' => 'C04',
                'nama' => 'Disinfection',
                'deskripsi' => 'Kami memastikan kesehatan rumah Anda dengan layanan disinfeksi dan pengendalian hama menggunakan bahan disinfektan yang efektif dan aman untuk membasmi kuman, virus, serta serangga yang mengganggu.',
                'gambar' => 'kategori-disinfection', 
                'created_at' => now(),
                'updated_at' => null,
                'status_del' => '0',
            ],
        ]);
    }
}
