<?php

namespace App\Http\Middleware;

use Closure;
use \Validator;
use App\ValidationRules;

class CustomerMiddleware
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $validation = Validator::make($request->all(), (new ValidationRules)->customer);
    if ($validation->fails()) :
      \Log::error('Vaildation Error', [$validation->messages()->all()]);
      return response()->json([
        'responseCode' => 400,
        'responseMessage' => 'An Error Occured. Kindly check your request parameters', 'error' => $validation->messages()->all()
      ],400);
    endif;
    return $next($request);
  }
}
