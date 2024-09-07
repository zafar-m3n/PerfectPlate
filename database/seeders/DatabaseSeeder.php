<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Slider;
use App\Models\Coupon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed other entities
        $this->call(UserSeeder::class);
        Slider::factory(3)->create();
        $this->call(CategorySeeder::class);

        Coupon::create([
            'name' => 'Summer Sale',
            'code' => 'SUMMER2024',
            'quantity' => 100,
            'min_purchase_amount' => 20,
            'expire_date' => now()->addDays(30),
            'discount_type' => 'percent',
            'discount' => '15',
            'status' => true
        ]);

        Coupon::create([
            'name' => 'Welcome Offer',
            'code' => 'WELCOME10',
            'quantity' => 50,
            'min_purchase_amount' => 50,
            'expire_date' => now()->addDays(60),
            'discount_type' => 'amount',
            'discount' => '10',
            'status' => true
        ]);

        Coupon::create([
            'name' => 'Black Friday',
            'code' => 'BLACKFRIDAY',
            'quantity' => 150,
            'min_purchase_amount' => 100,
            'expire_date' => now()->addDays(90),
            'discount_type' => 'percent',
            'discount' => '25',
            'status' => true
        ]);

        Product::factory()->create([
            'name' => 'Grilled Chicken',
            'slug' => 'grilled-chicken',
            'thumb_image' => '/uploads/chicken.jpg',
            'category_id' => 2,
            'short_description' => 'Tender grilled chicken breast with herbs.',
            'long_description' => 'Our grilled chicken breast is seasoned with a special blend of herbs and spices, cooked to perfection for a juicy and flavorful meal. Served with a side of vegetables.',
            'price' => 15.99,
            'offer_price' => 12.99,
            'quantity' => 20,
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'show_at_home' => true,
            'status' => true,
        ]);

        Product::factory()->create([
            'name' => 'Caesar Salad',
            'slug' => 'caesar-salad',
            'thumb_image' => '/uploads/salad.jpg',
            'category_id' => 1,
            'short_description' => 'Fresh salad with Caesar dressing.',
            'long_description' => 'Crisp romaine lettuce topped with parmesan, croutons, and our creamy Caesar dressing. A light and refreshing choice.',
            'price' => 9.99,
            'offer_price' => 7.99,
            'quantity' => 25,
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'show_at_home' => true,
            'status' => true,
        ]);

        Product::factory()->create([
            'name' => 'Pasta Carbonara',
            'slug' => 'pasta-carbonara',
            'thumb_image' => '/uploads/spaghetti.jpg',
            'category_id' => 2,
            'short_description' => 'Creamy pasta with bacon.',
            'long_description' => 'Classic Italian pasta dish with a rich and creamy sauce made from eggs, parmesan, and crispy bacon. A delightful treat for pasta lovers.',
            'price' => 12.99,
            'offer_price' => 10.99,
            'quantity' => 15,
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'show_at_home' => true,
            'status' => true,
        ]);

        Product::factory()->create([
            'name' => 'Margherita Pizza',
            'slug' => 'margherita-pizza',
            'thumb_image' => '/uploads/pizza.jpg',
            'category_id' => 1,
            'short_description' => 'Classic pizza with tomato and mozzarella.',
            'long_description' => 'A simple yet flavorful pizza featuring fresh tomato sauce, mozzarella cheese, and basil leaves, baked to perfection on a thin, crispy crust.',
            'price' => 8.99,
            'offer_price' => 6.99,
            'quantity' => 30,
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'show_at_home' => true,
            'status' => true,
        ]);

        Product::factory()->create([
            'name' => 'Tiramisu',
            'slug' => 'tiramisu',
            'thumb_image' => '/uploads/tiramisu.jpg',
            'category_id' => 1,
            'short_description' => 'Traditional Italian dessert.',
            'long_description' => 'Layers of espresso-soaked ladyfingers and rich mascarpone cream, dusted with cocoa powder. A perfect ending to any meal.',
            'price' => 6.99,
            'offer_price' => 5.49,
            'quantity' => 10,
            'sku' => fake()->unique()->ean13(),
            'seo_title' => fake()->sentence(),
            'seo_description' => fake()->paragraph(),
            'show_at_home' => true,
            'status' => true,
        ]);
    }
}
