<?php

class Alter_users_for_api {

    private $_lava;
    protected $dbforge;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
{
    $fields = [

        'password' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => TRUE
        ],

        'role' => [
            'type'       => 'VARCHAR',
            'constraint' => 50,
            'default'    => 'user'
        ],

        'is_active' => [
            'type'       => 'TINYINT',
            'constraint' => 1,
            'default'    => 1
        ],

        'created_at' => [
            'type' => 'TIMESTAMP',
            'null' => TRUE
        ],

        'updated_at' => [
            'type' => 'TIMESTAMP',
            'null' => TRUE
        ]

    ];

    $this->_lava->dbforge->add_column('users', $fields);
}

   public function down()
{
    $this->_lava->dbforge->drop_column('users', 'password');
    $this->_lava->dbforge->drop_column('users', 'role');
    $this->_lava->dbforge->drop_column('users', 'is_active');
    $this->_lava->dbforge->drop_column('users', 'created_at');
    $this->_lava->dbforge->drop_column('users', 'updated_at');
}
}