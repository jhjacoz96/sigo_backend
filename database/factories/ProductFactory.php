<?php

namespace Database\Factories;

use \App\Models\Product;
use \App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $name = $faker->unique()->productName;
        $pricePurchase = $this->faker->randomNumber(4);
        $priceSale = $pricePurchase + ($pricePurchase * 0.20);
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'code' => \Str::random(3),
            'price_sale' => $priceSale,
            'price_purchase' => $pricePurchase,
            'stock' => $this->faker->randomNumber(2),
            'status' => 'A',
            'comment' => null,
            'category_id' => Category::inRandomOrder()->value('id') ?: factory(Category::class),
        ];
    }
}
