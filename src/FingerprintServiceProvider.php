<?php

namespace Crumbls\Fingerprint;

use Blade;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use O2Group\Authentication\Console\Commands\InstallCommand;

class FingerprintServiceProvider extends ServiceProvider
{
	/**
	 * Boot our package.
	 */
    public function boot()
    {
	    $this->loadViewsFrom(__DIR__.'/Views', 'fingerprint');
		$this->bootDirective();
	    $this->bootRoutes();
	}

	/**
	 * Bring our directive online.
	 */
	protected function bootDirective() : void {
		Blade::directive('fingerprint', function() {
			$fingerprint = \Session::get('fingerprint');
			return "<?php echo view('fingerprint::fingerprint', ['session' => '$fingerprint'])->render(); ?>";
		});
	}

	/**
	 * Bring all routes online
	 */
    protected function bootRoutes() : void {
		$this->loadRoutesFrom(__DIR__.'/Routes/web.php');
    }

	/**
	 * Register our package provider.
	 */
    public function register()
    {
	}


}