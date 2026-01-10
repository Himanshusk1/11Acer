<?php

/**
 * The goal of this file is to allow developers a location
 * where they can overwrite core procedural functions and
 * replace them with their own. This file is loaded during
 * the bootstrap process and is called during the framework's
 * execution.
 *
 * This can be looked at as a `master helper` file that is
 * loaded early on, and may also contain additional functions
 * that you'd like to use throughout your entire application
 *
 * @see: https://codeigniter.com/user_guide/extending/common.html
 */

if (!function_exists('role_dashboard_path')) {
	/**
	 * Resolve the correct dashboard path for the supplied role.
	 */
	function role_dashboard_path(?string $role): string
	{
		if ($role === 'admin') {
			return '/admin';
		}

		return '/dashboard';
	}
}

if (!function_exists('is_recognized_role')) {
	/**
	 * Basic validation to ensure the supplied role maps to a known type.
	 */
	function is_recognized_role(?string $role): bool
	{
		$validRoles = ['admin', 'individual', 'agent', 'builder', 'buyer', 'owner', 'broker', 'service'];
		return $role !== null && in_array($role, $validRoles, true);
	}
}
