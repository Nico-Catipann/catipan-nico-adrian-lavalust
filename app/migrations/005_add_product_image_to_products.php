<?php

class Add_product_image_to_products {

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
        'product_image' => [
            'type'       => 'VARCHAR',
            'constraint' => 255,
            'null'       => TRUE
        ]
    ];

    $this->_lava->dbforge->add_column(
        'products',
        $fields
    );
}

   public function down()
{
    $this->_lava->dbforge->drop_column(
        'products',
        'product_image'
    );
}
}