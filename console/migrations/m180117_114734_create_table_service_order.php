<?php

use yii\db\Migration;

/**
 * Class m180117_114734_create_table_service_order
 */
class m180117_114734_create_table_service_order extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%service_order}}', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->notNull(),
            'engener_id'  => $this->integer(),
            'status_id'   => $this->integer()->notNull(),
            'name_service'=> $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'company'     => $this->string()->notNull(),
            'place'       => $this->string()->notNull(),
            'address'     => $this->string()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-order-user_id', '{{%service_order}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-order-status_id', '{{%service_order}}', 'status_id', '{{%status}}', 'id', 'CASCADE', 'RESTRICT');


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%service_order}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_114734_create_table_service_order cannot be reverted.\n";

        return false;
    }
    */
}
