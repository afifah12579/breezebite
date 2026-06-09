<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kosongkan data lama supaya tidak bertindih setiap kali di-seed
        Item::truncate();

        // ==========================================
        // 🍔 1. KATEGORI: FOODS (MAKANAN)
        // ==========================================
        Item::create([
            'name' => 'Nasi Kerabu Ayam Goreng',
            'category' => 'Foods',
            'price' => 10.50,
            'description' => 'Traditional blue rice served with crispy fried chicken, salted egg, and local herbs.',
            'image' => '"C:\xampp\htdocs\breezebite-main\public\images\nasi-kerabu.jpg"'
        ]);

        Item::create([
            'name' => 'Chicken Chop Crispy',
            'category' => 'Foods',
            'price' => 14.70,
            'description' => 'Golden fried chicken chop served with signature black pepper sauce and crinkle fries.',
            'image' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?w=600&auto=format&fit=crop&q=80'
        ]);

        Item::create([
            'name' => 'Spaghetti Carbonara',
            'category' => 'Foods',
            'price' => 10.40,
            'description' => 'Rich, creamy white sauce pasta tossed with mushrooms and chicken slices.',
            'image' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=600&auto=format&fit=crop&q=80'
        ]);

        Item::create([
            'name' => 'Nasi Goreng Kampung',
            'category' => 'Foods',
            'price' => 8.50,
            'description' => 'Spicy traditional fried rice cooked with anchovies, kangkung, and birds eye chili.',
            'image' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=600&auto=format&fit=crop&q=80'
        ]);


        // ==========================================
        // 🥤 2. KATEGORI: DRINKS (MINUMAN)
        // ==========================================
        Item::create([
            'name' => 'Teh Ais Premium',
            'category' => 'Drinks',
            'price' => 4.50,
            'description' => 'Perfectly brewed milk tea served chilled over ice.',
            'image' => 'teh-ais.jpg'
        ]);

        Item::create([
            'name' => 'Milo Ais Kaw',
            'category' => 'Drinks',
            'price' => 4.00,
            'description' => 'Classic Malaysian chocolate malt drink mixed thick and creamy.',
            'image' => 'https://images.unsplash.com/photo-1541658016709-82535e94bc69?w=600&auto=format&fit=crop&q=80'
        ]);

        Item::create([
            'name' => 'Fresh Orange Juice',
            'category' => 'Drinks',
            'price' => 6.00,
            'description' => 'Pure freshly squeezed orange juice rich in Vitamin C.',
            'image' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=600&auto=format&fit=crop&q=80'
        ]);


        // ==========================================
        // 🍿 3. KATEGORI: SNACKS (KUDAPAN)
        // ==========================================
        Item::create([
            'name' => 'Curry Puff Crispy',
            'category' => 'Snacks',
            'price' => 3.00,
            'description' => 'Flaky pastry shell filled with savory spiced potato curry.',
            'image' => 'https://images.unsplash.com/photo-1541518763669-27fef04b14ea?w=600&auto=format&fit=crop&q=80'
        ]);

        Item::create([
            'name' => 'French Fries',
            'category' => 'Snacks',
            'price' => 5.00,
            'description' => 'Deep-fried golden potato strips lightly seasoned with sea salt.',
            'image' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=600&auto=format&fit=crop&q=80'
        ]);
        
        Item::create([
            'name' => 'Chicken Nuggets',
            'category' => 'Snacks',
            'price' => 6.50,
            'description' => 'Crispy tempura chicken nuggets served with chili sauce.',
            'image' => 'https://images.unsplash.com/photo-1562967914-608f82629710?w=600&auto=format&fit=crop&q=80'
        ]);
    }
}