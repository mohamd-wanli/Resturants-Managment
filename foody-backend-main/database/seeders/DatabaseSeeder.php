<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Branch;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\User;
use App\Statuses\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Admin::create([
            'email' => 'admin@example.com',
            'password' => Hash::make(12345678),
        ]);
        $restaurant = Restaurant::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make(12345678),
        ]);

        $branch = Branch::create([
            'name' => 'admin',
            'restaurant_id' => $restaurant->id,
        ]);
        $category = Category::create([
            'name' => 'pizza',
            'branch_id' => $branch->id,
            'restaurant_id' => $restaurant->id,
        ]);
        $table = Table::create([
            'table_num' => 'table',
            'unique_id' => Str::uuid(),
            'branch_id' => $branch->id,
            'restaurant_id' => $restaurant->id,
            'Qr_code_path' => 'qqqqqq',
        ]);

        $product = DB::table('products')->insert([
            'name' => 'vegetable pizza',
            'price' => 133,
            'description' => 'good',
            'image' => 'food.jpg',
            'estimated_time' => '15:41:30',
            'branch_id' => $branch->id,
            'restaurant_id' => $restaurant->id,
            'category_id' => $category->id,
        ]);
        $category = Category::create([
            'name' => 'drinks',
            'branch_id' => $branch->id,
            'restaurant_id' => $restaurant->id,
        ]);
        $waiter = User::create([
            'name' => 'waiter',
            'email' => 'waiter@example.com',
            'password' => Hash::make(12345678),
            'user_type' => UserStatus::WAITER,
            'branch_id' => $branch->id,
            'restaurant_id' => $restaurant->id,
        ]);
        $chef = User::create([
            'name' => 'chef',
            'email' => 'chef@example.com',
            'password' => Hash::make(12345678),
            'user_type' => UserStatus::CHEF,
            'branch_id' => $branch->id,
            'restaurant_id' => $restaurant->id,
        ]);
    }
}
