<?php

namespace Modules\Tasks\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Tasks\Models\Task;
use App\Models\User;

class TasksDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();
        $user = User::factory()->create(['role' => 'user']);
        Task::factory()->count(10)->create(['user_id' => $user->id]);

    }
}
