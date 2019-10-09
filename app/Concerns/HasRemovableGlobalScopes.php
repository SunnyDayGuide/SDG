<?php

namespace App\Concerns;

use Closure;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Arr;

trait HasRemovableGlobalScopes {

	/**
	 * @param  \Illuminate\Database\Eloquent\Scope|string  $scope
	 */
	public static function withoutGlobalScope( $scope )
	{
		if (is_string($scope) && is_array(static::$globalScopes[static::class])) {
			Arr::forget(static::$globalScopes[static::class], $scope);
		} elseif ($scope instanceof Closure) {
			Arr::forget(static::$globalScopes[static::class], spl_object_hash($scope));
		} elseif ($scope instanceof Scope) {
			Arr::forget(static::$globalScopes[static::class], get_class($scope));
		}
	}

	/**
	 * @param \Illuminate\Database\Eloquent\Scope[]|string[] $scopes
	 */
	public static function withoutGlobalScopes( array $scopes = [])
	{
		if(empty($scopes)) {
			static::$globalScopes = [];
		} else {
			foreach($scopes as $scope) {
				static::withoutGlobalScope($scope);
			}
		}
	}
}