<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * Middleware: LoginMiddleware
 * 
 * Automatically generated via CLI.
 */
class LoginMiddleware
{
    /**
     * Handle the incoming request
     *
     * @param Closure $next
     * @return mixed
     */
    public function handle(Closure $next)
    {
        // TODO: Add your middleware logic here (authentication, authorization, etc.)
       if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
        $_SESSION['login_error'] = 'Please sign in first to access the product management dashboard.';
            redirect('login');
            exit;
        }

        return $next();
    }
}
