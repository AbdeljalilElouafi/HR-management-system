<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserBelongsToCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the authenticated user's company ID
        $companyId = auth()->user()->company_id;

        // Check if the requested resource belongs to the user's company
        if ($request->route('employee')) {
            $employee = $request->route('employee');
            if ($employee->company_id !== $companyId) {
                abort(403, 'Unauthorized action.');
            }
        }

        if ($request->route('department')) {
            $department = $request->route('department');
            if ($department->company_id !== $companyId) {
                abort(403, 'Unauthorized action.');
            }
        }

        if ($request->route('emploi')) {
            $emploi = $request->route('emploi');
            if ($emploi->company_id !== $companyId) {
                abort(403, 'Unauthorized action.');
            }
        }

        return $next($request);
    }
}
