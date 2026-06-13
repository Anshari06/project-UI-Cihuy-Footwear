<?php

namespace Database\Seeders;

use App\Models\Artikel;
use Illuminate\Database\Seeder;

class ArtikelSeeder extends Seeder
{
    public function run(): void
    {
        $artikel = [
            [
                'title' => 'Panduan Memilih Hunter Boots yang Tepat',
                'slug' => 'panduan-memilih-hunter-boots',
                'content' => 'Hunter boots adalah pilihan tepat untuk musim hujan. Berikut tips memilih yang tepat untuk kaki Anda. Pastikan memilih bahan yang waterproof, ukurannya pas, dan sesuai dengan kebutuhan aktivitas outdoor Anda.',
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSeO5-Kca2SuNnSWUEhax3t7SgCcDvYzy0JDg&s',
                'author' => 'Admin Cihuy',
                'category' => 'trending',
                'published_at' => now(),
            ],
            [
                'title' => 'Sneakers vs Running Shoes: Apa Bedanya?',
                'slug' => 'sneakers-vs-running-shoes',
                'content' => 'Kenali perbedaan bantalan, fleksibilitas, dan ketahanan sol antara sneakers dan running shoes. Sneakers cocok untuk gaya kasual sehari-hari, sedangkan running shoes dirancang khusus untuk aktivitas lari dengan teknologi bantalan khusus.',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=400&fit=crop',
                'author' => 'Admin Cihuy',
                'category' => 'trending',
                'published_at' => now(),
            ],
            [
                'title' => '5 Tips Merawat Sepatu Kulit Agar Tahan Lama',
                'slug' => 'tips-merawat-sepatu-kulit',
                'content' => 'Perawatan tepat untuk sepatu kulit kesayangan Anda agar tetap terlihat baru dan awet. Gunakan polish secara rutin, simpan di tempat kering, dan gunakan shoe tree untuk menjaga bentuk sepatu kulit Anda.',
                'image' => 'https://images.unsplash.com/photo-1614252235316-8c857d38b5f4?w=600&h=400&fit=crop',
                'author' => 'Admin Cihuy',
                'category' => 'all',
                'published_at' => now(),
            ],
            [
                'title' => 'Cara Memilih Size Sepatu yang Tepat',
                'slug' => 'cara-memilih-size-sepatu',
                'content' => 'Jangan sampai salah pilih ukuran! Ikuti panduan ini agar sepatu terasa nyaman di kaki. Selalu ukur kaki di sore hari karena kaki cenderung membengkak, dan coba berdiri saat mengukur untuk mendapatkan ukuran yang akurat.',
                'image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600&h=400&fit=crop',
                'author' => 'Admin Cihuy',
                'category' => 'all',
                'published_at' => now(),
            ],
            [
                'title' => 'Mengenal Teknologi Sol Sepatu dan Fungsinya',
                'slug' => 'teknologi-sol-sepatu',
                'content' => 'Setiap tipe sol sepatu memiliki kelebihan masing-masing. EVA foam ringan dan empuk, rubber lebih tahan slip, sedangkan polyurethane menawarkan daya tahan tinggi. Pilih sol yang sesuai dengan aktivitas utama Anda agar kenyamanan maksimal.',
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=400&fit=crop',
                'author' => 'Admin Cihuy',
                'category' => 'trending',
                'published_at' => now(),
            ],
            [
                'title' => 'Sepatu Pria vs Sepatu Wanita: Apa Bedanya?',
                'slug' => 'sepatu-pria-vs-wanita',
                'content' => 'Tahukah Anda bahwa sepatu pria dan wanita tidak hanya berbeda dari segi ukuran dan warna? Desain last (cetakan) pria umumnya lebih lebar dengan penopang arches yang lebih kuat, sementara wanita membutuhkan fleksibilitas lebih di area forefoot.',
                'image' => 'https://images.unsplash.com/photo-1512374382149-233c42b6a83b?w=600&h=400&fit=crop',
                'author' => 'Admin Cihuy',
                'category' => 'all',
                'published_at' => now(),
            ],
            [
                'title' => 'Kapan Waktu yang Tepat Ganti Sepatu Baru?',
                'slug' => 'kapan-ganti-sepatu-baru',
                'content' => 'Sepatu olahraga sebaiknya diganti setiap 500-800 km penggunaan. Tanda-tanda perlu ganti: sol aus, bantalan berkurang kenyamanannya, bagian atas mulai sobek, atau sudah terasa tidak nyaman meski masih terlihat bagus dari luar.',
                'image' => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=600&h=400&fit=crop',
                'author' => 'Admin Cihuy',
                'category' => 'all',
                'published_at' => now(),
            ],
        ];

        foreach ($artikel as $data) {
            Artikel::create($data);
        }
    }
}
