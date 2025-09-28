<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
	public function login()
	{
		$data['title'] = 'Login';
		return view('auth/login', $data);
	}

	public function attemptLogin()
	{
		$session = session();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$model = new UserModel();
		$user = $model->verifyCredentials($username, $password);
		if (!$user) {
			return redirect()->back()->with('error', 'Username atau password salah');
		}

		$session->set([
			'user_id' => $user['id'],
			'username' => $user['username'],
			'role' => $user['role'],
		]);

		return redirect()->to('/');
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/login');
	}
}




