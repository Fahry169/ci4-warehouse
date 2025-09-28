<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $allowedFields = ['username', 'email', 'password_hash', 'role', 'created_at', 'updated_at'];
	protected $returnType = 'array';
	protected $useTimestamps = true;

	public function createUser(string $username, string $password, ?string $email = null, string $role = 'user'): int
	{
		$passwordHash = password_hash($password, PASSWORD_DEFAULT);
		$this->insert([
			'username'      => $username,
			'email'         => $email,
			'password_hash' => $passwordHash,
			'role'          => $role,
		]);
		return (int) $this->getInsertID();
	}

	public function verifyCredentials(string $username, string $password): ?array
	{
		$user = $this->where('username', $username)->first();
		if (!$user) {
			return null;
		}
		if (!password_verify($password, $user['password_hash'])) {
			return null;
		}
		return $user;
	}
}