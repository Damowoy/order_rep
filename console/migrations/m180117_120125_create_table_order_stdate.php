<?php

use yii\db\Migration;

/**
 * Class m180117_120125_create_table_order_stdate
 */
class m180117_120125_create_table_order_stdate extends Migration
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

        $this->createTable('{{%order_stdate}}', [
            'id'               => $this->primaryKey(),
            'service_order_id' => $this->integer()->notNull(),
            'status_id'        => $this->integer()->notNull(),
            'start_date'       => $this->dateTime()->notNull(),
            'end_date'         => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-orderstdate-service_order_id', '{{%order_stdate}}', 'service_order_id', '{{%service_order}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-orderstdate-status_id', '{{%order_stdate}}', 'status_id', '{{%status}}', 'id', 'CASCADE', 'RESTRICT');


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_stdate}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_120125_create_table_order_stdate cannot be reverted.\n";

        return false;
    }
    */
}
