<?php

namespace LithiumHosting\WebApps\Starter;

use Module\Support\Webapps\App\Type\Unknown\Handler as Unknown;

class Handler extends Unknown
{
	const NAME       = 'Starter';
	const ADMIN_PATH = "";
	const LINK       = 'https://github.com/lithiumhosting';

	const DEFAULT_FORTIFICATION = 'max';
	const FEAT_ALLOW_SSL        = true;

	public function display(): bool
	{
		return version_compare($this->php_version(), '7', '>=');
	}

	public function hasUpdate(): bool
	{
		return true;
	}
}