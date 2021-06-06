<?php
namespace App\Http\Views;

use App\Models\User;

class UserViewComposer
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = auth()->user();
	}

	public function compose($view)
	{
		return $view->with('user', $this->user);
	}
}