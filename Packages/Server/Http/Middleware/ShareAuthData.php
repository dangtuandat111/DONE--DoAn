<?php

namespace Packages\Server\Http\Middleware;

use Closure;
use Packages\Server\Repository\Admin\AdminRepository;

class ShareAuthData
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
        if (\Auth::guard('admin')->id()) {
            $admin_data = AdminRepository::getInfo(\Auth::guard('admin')->id())[0];
            if ($admin_data->avatar) {
                $admin_data->avatar = 'DoAnTotNghiep/server/assets/images/' . $admin_data->avatar;
            } else {
                $admin_data->avatar = 'DoAnTotNghiep/server/assets/images/admin_default.png';
            }

            \View::share('admin_data', $admin_data);
        }

        if ( \Auth::guard('admin')->id() && !empty($admin_data) && $admin_data->role == 0)
        {
            if (str_contains(\Route::current()->uri, 'admin/account')) {
                return back()->withErrors('Message Error: You don`t have permission to access this route.');
            }
        }
        return $next($request);
    }

}
