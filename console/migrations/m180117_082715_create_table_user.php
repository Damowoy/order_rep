<?php

use yii\db\Migration;

/**
 * Class m180117_082715_create_table_user
 */
class m180117_082715_create_table_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id'         => $this->primaryKey(),
            'role_id'    => $this->integer(),
            'username'   => $this->string()->notNull(),
            'auth_key'   => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'lastname'   => $this->string(32)->notNull(),
            'firstname'  => $this->string(32)->notNull(),
            'phone'      => $this->string(32)->notNull(),
            'email'      => $this->string()->notNull(),
            'status'     => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

     //   $this->createIndex('idx-token-user_id', '{{%user}}', 'role_id');
        $this->addForeignKey('fk-role-user_id', '{{%user}}', 'role_id', '{{%role}}', 'id', 'CASCADE', 'RESTRICT');



      /*  $this->insert('{{%user}}', [
            'username'      => 'admin',
            'password_hash' => '$2y$13$uqe3LPW9ya3RZhynJpPN5um9fvdxUmoqjOqQBJDdIDXSKxRZB5bPu',
            'status'        => 10,
            'email'         => "d3.vasilevsky@itransition.com",
            'lastname'      => 'administrator'
        ]);*/
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180117_082715_create_table_user cannot be reverted.\n";

        return false;
    }
    */
}
