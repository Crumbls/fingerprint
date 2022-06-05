<?php

namespace Crumbls\Fingerprint\Controllers;

//use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
//use Illuminate\Foundation\Bus\DispatchesJobs;
use Crumbls\Fingerprint\Events\Fingerprint;
use Crumbls\Fingerprint\Requests\FingerprintRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class FingerprintController extends BaseController
{
    use ValidatesRequests;

	public function __invoke(FingerprintRequest $request) {
		abort_if(!$request->hasValidSignature(), 403);
		$data = $request->validated();

		// TODO: Improve this for other use cases.
		$model = \Config::get('auth.providers.users.model', \App\Models\User::class);

		$user = array_key_exists('user_id', $data) && $data['user_id'] ? $model::find($data['user_id']) : null;

		Fingerprint::dispatch($data['fingerprint'], $request->ip(), $user);

		\Session::put('fingerprint', $data['fingerprint']);

		return response()->json(['fingerprint' => $data['fingerprint']]);
	}
}
