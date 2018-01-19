<?php

use yii\db\Migration;

/**
 * Class m180117_113606_create_table_firm
 */
class m180117_113606_create_table_firm extends Migration
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

        $this->createTable('{{%firm}}', [
            'id'           => $this->primaryKey(),
            'parent_id'    => $this->integer()->notNull(),
            'name'         => $this->string()->notNull(),
            'description'  => $this->text(),
            'address'      => $this->string()->notNull(),

        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%firm}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_113606_create_table_firm cannot be reverted.\n";

        return false;
    }
    */
}
