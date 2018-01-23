<?php

use yii\db\Migration;

/**
 * Class m180117_114502_create_table_status
 */
class m180117_114502_create_table_status extends Migration
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

        $this->createTable('{{%status}}', [
            'id'      => $this->primaryKey(),
            'name'    => $this->string()->notNull(),
        ], $tableOptions);
    
        $this->insert('{{%status}}', [
            'name'  => 'Open'
        ]);
        $this->insert('{{%status}}', [
            'name'      => 'Assigned',
        ]);
        $this->insert('{{%status}}', [
            'name'      => 'In Process ',
        ]);
        $this->insert('{{%status}}', [
            'name'      => 'Resolved',
        ]);
        $this->insert('{{%status}}', [
            'name'      => 'Closed',
        ]);
        $this->insert('{{%status}}', [
            'name'      => 'Reopened',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%status}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_114502_create_table_status cannot be reverted.\n";

        return false;
    }
    */
}
