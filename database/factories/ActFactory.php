<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Act>
 */
class ActFactory extends Factory
{

    protected $model = Act::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date_start'  => $this->faker->date,
            'date_end'    => $this->faker->date,
            'project_id'  => Project::factory(),
            'contract_id' => Contract::factory(),
        ];
    }
}
