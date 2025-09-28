<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$model = new UserModel();
		if (!$model->where('username', 'admin')->first()) {
			$model->createUser('admin', 'admin123', 'admin@example.com', 'admin');
		}
	}
}




