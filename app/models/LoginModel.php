<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: LoginModal
 * 
 * Automatically generated via CLI.
 */
class LoginModel extends Model {
    protected $table = 'admins';
    protected $primary_key = 'id';
    protected $fillable = [];
    protected $guarded = ['id'];

    public function __construct()
    {
        parent::__construct();
    }
    public function get_admin_by_username($username) {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get(); 
    }
}