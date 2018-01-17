<?php

use yii\db\Migration;

/**
 * Class m180117_114001_create_table_user_firm
 */
class m180117_114001_create_table_user_firm extends Migration
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

        $this->createTable('{{%user_film}}', [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->notNull(),
            'firm_id'    => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addForeignKey('fk-user-user_id', '{{%user_film}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk-firm-user_id', '{{%user_film}}', 'firm_id', '{{%firm}}', 'id', 'CASCADE', 'RESTRICT');


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_film}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_114001_create_table_user_firm cannot be reverted.\n";

        return false;
    }
    */
}
