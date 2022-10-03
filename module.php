<?php

use LithiumHosting\WebApps\Starter\Handler;
use Module\Support\Webapps;
use Module\Support\Webapps\DatabaseGenerator;
use Module\Support\Webapps\VersionFetcher\Github;
use Opcenter\Auth\Password;
use Opcenter\Versioning;

/**
 * Web application management
 *
 * @package core
 */
class Starter_Module extends Webapps
{
	const APP_NAME             = Handler::NAME;
	const DEFAULT_VERSION_LOCK = 'minor';

	protected $aclList = [
		'min' => [
			'test'
		],
		'max' => [
			'test'
		],
	];

	/**
	 * Install application
	 *
	 * @param string $hostname domain or subdomain to install application
	 * @param string $path     optional path under hostname
	 * @param array  $opts     additional install options
	 * @return bool
	 */
	public function install(string $hostname, string $path = '', array $opts = []): bool {
		// TODO: Implement install() method.
	}

	/**
	 * Get all available versions sorted in ascending semantic version
	 *
	 * @return array
	 */
	public function get_versions(): array {
		// TODO: Implement get_versions() method.
	}

	/**
	 * Get installed version
	 *
	 * @param string $hostname
	 * @param string $path
	 * @return string|null|bool version number, null if not app or false on failure
	 */
	public function get_version(string $hostname, string $path = ''): ?string {
		// TODO: Implement get_version() method.
	}

	/**
	 * Location is a valid webapp install
	 *
	 * @param string $hostname or $docroot
	 * @param string $path
	 * @return bool
	 */
	public function valid(string $hostname, string $path = ''): bool {
		// TODO: Implement valid() method.
	}

	/**
	 * Update core, plugins, and themes atomically
	 *
	 * @param string $hostname subdomain or domain
	 * @param string $path     optional path under hostname
	 * @param string $version
	 * @return bool
	 */
	public function update_all(string $hostname, string $path = '', string $version = null): bool {
		return $this->update($hostname, $path, $version);
	}

	/**
	 * Update application to latest version
	 *
	 * @param string $hostname domain or subdomain under which application is installed
	 * @param string $path     optional subdirectory
	 * @param string $version
	 * @return bool
	 */
	public function update(string $hostname, string $path = '', string $version = null): bool {
		// TODO: Implement update() method.
	}

	/**
	 * Get database configuration for application
	 *
	 * @param string $hostname domain or subdomain of wp blog
	 * @param string $path     optional path
	 * @return bool|array
	 */
	public function db_config(string $hostname, string $path = '')
	{
		$approot = $this->getAppRoot($hostname, $path);
		if (! $this->file_exists($approot.'/LocalSettings.php')) {
			return false;
		}

		$code = 'ob_start(); function wfLoadSkin(){}; function wfLoadExtension(){}; define(\'MEDIAWIKI\', TRUE); include("./LocalSettings.php"); file_put_contents("php://fd/3", serialize(["db" => $wgDBname, "user" => $wgDBuser, "host" => $wgDBserver, "prefix" => $wgDBprefix, "password" =>  $wgDBpassword])); ';
		$cmd = 'cd %(path)s && php -d mysqli.default_socket=%(socket)s -r %(code)s 3>&1-';
		$ret = $this->pman_run($cmd, [
			'path'   => $approot,
			'code'   => $code,
			'socket' => ini_get('mysqli.default_socket')
		]);

		if (! $ret['success']) {
			return error("failed to obtain %(app)s configuration for `%(approot)s': %(err)s", [
				'app'     => static::APP_NAME,
				'approot' => $approot,
				'err'     => $ret['stderr']
			]);
		}

		return \Util_PHP::unserialize(trim($ret['stdout']));
	}
}