<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * Middleware: StudentMiddleware
 * 
 * Automatically generated via CLI.
 */
class StudentMiddleware
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

       if (!isset($_SESSION['student_access']) || $_SESSION['student_access'] !== true) {
            $_SESSION['flash_error'] = 'Waw sino ka?: Oops oops oops, Bawal ka dito! Oops oops oops';
            redirect('/student');
            exit;
        }

        return $next();
    }
}
