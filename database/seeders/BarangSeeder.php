<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class barangseeder extends Seeder
{
    public function run(): void
    {
        $barang = [
            [
                'name' => 'Converse Chuck Taylor All Star Black',
                'price' => 1499000,
                'brand' => 'Converse',
                'badge' => 'Best Seller',
                'type' => 'sneakers',
                'gender' => 'pria',
                'description' => 'Converse Chuck Taylor All Star adalah sepatu kasual yang nyaman dan stylish, cocok untuk berbagai kesempatan.',
                'image' => 'converse_allstarblack.png',
            ],
            [
                'name' => 'Prabu Leather Formal Black',
                'price' => 749000,
                'brand' => 'Prabu',
                'badge' => 'New Arrival',
                'type' => 'leather',
                'gender' => 'pria',
                'description' => 'Prabu Leather Formal adalah sepatu formal yang elegan dan berkualitas tinggi, dirancang untuk pria yang menghargai gaya klasik.',
                'image' => 'prabu_loaferblack.png',
            ],
            [
                'name' => 'Hoka Clifton 10 Black',
                'price' => 2000000,
                'brand' => 'Hoka',
                'badge' => 'New Arrival',
                'type' => 'olahraga',
                'gender' => 'pria',
                'description' => 'Hoka Clifton 10 adalah sepatu lari yang dirancang untuk memberikan kenyamanan maksimal selama aktivitas olahraga.',
                'image' => 'hoka_clifton10black.png',
            ],
            [
                'name' => 'Adidas Ultraboost 22 Black',
                'price' => 2500000,
                'brand' => 'Adidas',
                'badge' => 'New Arrival',
                'type' => 'olahraga',
                'gender' => 'wanita',
                'description' => 'Adidas Ultraboost 22 adalah sepatu lari yang dirancang untuk memberikan kenyamanan dan performa tinggi.',
                'image' => 'adidas_Ultraboost22Black.png',
            ],
            [
                'name' => 'Nike Air Force 1 White',
                'price' => 1500000,
                'brand' => 'Nike',
                'badge' => 'Best Seller',
                'type' => 'sneakers',
                'gender' => 'unisex',
                'description' => 'Nike Air Force 1 adalah sepatu ikonik yang telah menjadi favorit di dunia fashion dan olahraga selama bertahun-tahun.',
                'image' => 'nike_airjordawhite.png',
            ],
            [
                'name' => 'Redwing Classic Moc Toe Boot Brown',
                'price' => 3000000,
                'brand' => 'Redwing',
                'badge' => 'New Arrival',
                'type' => 'boots',
                'gender' => 'pria',
                'description' => 'Redwing Men\'s Classic Moc Toe Boot adalah sepatu boots yang dirancang untuk pria yang menghargai kualitas dan keawetan.',
                'image' => 'redwings_moctoe.png',
            ],
            [
                'name' => 'Adidas Handball Spezial Blue',
                'price' => 1200000,
                'brand' => 'Adidas',
                'badge' => 'Best Seller',
                'type' => 'sneakers',
                'gender' => 'unisex',
                'description' => 'Adidas Handball Spezial adalah sepatu sneakers yang dirancang untuk memberikan kenyamanan dan performa tinggi.',
                'image' => 'adidas_handballblue.png',
            ],
            [
                'name' => 'Hoka Arahi 7 Pink',
                'price' => 2200000,
                'brand' => 'Hoka',
                'badge' => 'New Arrival',
                'type' => 'olahraga',
                'gender' => 'wanita',
                'description' => 'Hoka Arahi 7 adalah sepatu running yang dirancang khusus untuk wanita dengan stabilitas dan kenyamanan tinggi.',
                'image' => 'hoka_arahi7.png',
            ],
            [
                'name' => 'Nike Air Max 90 Kids',
                'price' => 899000,
                'brand' => 'Nike',
                'badge' => 'Best Seller',
                'type' => 'sneakers',
                'gender' => 'anak',
                'description' => 'Nike Air Max 90 Kids adalah sepatu sneakers anak-anak yang stylish dan nyaman untuk aktivitas sehari-hari.',
                'image' => 'Nike_AirMaxKidsBlack.png',
            ],
        ];

        foreach ($barang as $data) {
            Barang::create($data);
        }
    }
}
