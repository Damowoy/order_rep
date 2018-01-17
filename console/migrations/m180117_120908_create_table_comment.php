<?php

use yii\db\Migration;

/**
 * Class m180117_120908_create_table_comment
 */
class m180117_120908_create_table_comment extends Migration
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

        $this->createTable('{{%comment}}', [
            'id'                => $this->primaryKey(),
            'service_order_id'  => $this->integer()->notNull(),
            'user_id'           => $this->integer()->notNull(),
            'comment'           => $this->text()->notNull(),
            'created_dt'        => $this->dateTime()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-comment-service_order_id', '{{%comment}}', 'service_order_id', '{{%service_order}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-comment-status_id', '{{%comment}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');



    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_120908_create_table_comment cannot be reverted.\n";

        return false;
    }
    */
}
