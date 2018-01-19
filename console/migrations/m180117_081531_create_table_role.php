<?php

use yii\db\Migration;

/**
 * Class m180117_081531_create_table_role
 */
class m180117_081531_create_table_role extends Migration
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

        $this->createTable('{{%role}}', [
            'id'         => $this->primaryKey(),
            'name'       => $this->string()->notNull()
        ], $tableOptions);

        $this->insert('{{%role}}', [
           'name'  => 'customer'
        ]);
        $this->insert('{{%role}}', [
           'name'      => 'manager',
        ]);
        $this->insert('{{%role}}', [
           'name'      => 'engener',
         ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('role');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_081531_create_table_role cannot be reverted.\n";

        return false;
    }
    */
}
