<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
	/**
	 * Handle the "creating" event.
	 *
	 * @param  User  $user
	 */
	public function creating(User $user): void{}

	/**
	 * Handle the "created" event.
	 *
	 * @param  User  $user
	 */
	public function created(User $user): void{}

	/**
	 * Handle the "updating" event.
	 *
	 * @param  User  $user
	 */
	public function updating(User $user): void{}

	/**
	 * Handle the "updated" event.
	 *
	 * @param  User  $user
	 */
	public function updated(User $user): void{}

	/**
	 * Handle the "saving" event.
	 *
	 * @param  User  $user
	 */
	public function saving(User $user): void{}

	/**
	 * Handle the "saved" event.
	 *
	 * @param  User  $user
	 */
	public function saved(User $user): void{}

	/**
	 * Handle the "deleting" event.
	 *
	 * @param  User  $user
	 */
	public function deleting(User $user): void{}

	/**
	 * Handle the "deleted" event.
	 *
	 * @param  User  $user
	 */
	public function deleted(User $user): void{}

    /**
	 * Handle the "restored" event.
	 *
	 * @param  User  $user
	 */
	public function restored(User $user): void{}

	/**
	 * Handle the "retrieved" event.
	 *
	 * @param  User  $user
	 */
	public function retrieved(User $user): void{}

}
