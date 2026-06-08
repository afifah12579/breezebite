<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //User::factory()->create([
           // 'name' => 'Test User',
           // 'email' => 'test@example.com',
        //]);

        User::create([
              'name' => 'Admin Staff',
              'email' => 'admin@breezebite.com',
              'password' => bcrypt('password123'),

        ]);

        Item::create([
        'name' => 'Nasi Kerabu',
         'category' => 'foods', 
         'price' => 10.50, 
         'description' => 'Enjoy our delicious Nasi Kerabu, served with fragrant coconut rice, crispy anchovies, roasted peanuts, fresh cucumber slices, boiled egg, and spicy sambal.',
        'image'=>'nasi-kerabu.jpg'
        ]);

        Item::create([
       'name' => 'Chicken Chop Crispy',
       'category' => 'foods',
       'price' => 14.70,
       'description' => 'Fried golden crispy chicken chop served with signature black pepper sauce, crinkle fries, and fresh coleslaw.',
       'image' => 'chicken_chop.jpg'
        ]);

        Item::create([
<<<<<<< HEAD
       'name' => 'Chicken tomyam',
       'category' => 'foods',
       'price' => 9.40,
       'description' => 'Deliciuos tomyam soup',
       'image' => 'tomyam.jpg'
        ]);

        Item::create([
=======
>>>>>>> eb7ddb798d8d0020bccf89ea1921df719de6dc82
            'name' => 'Teh Ais',
            'category' => 'drinks',
            'price' => 3.50,
            'description' => 'Refreshing chocolate malt beverage.',
            'image' => 'teh-ais.jpg'
        ]);
        
        Item::create([
            'name' => 'Curry Puff',
            'category' => 'snacks',
            'price' => 2.00,
            'description' => 'Crispy pastry filled with spiced potato.',
            'image' => 'kentang.jpg'
        ]);
        
        Item::create([
            'name' => 'keropok lekot',
            'category' => 'snacks',
            'price' => 2.00,
            'description' => 'Crispy fish',
            'image' => 'kentang.jpg'
        ]);
        
        
        
        
        
        
        
        
        
        
        

    }
}


