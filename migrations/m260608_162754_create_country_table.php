<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%country}}`.
 */
class m260608_162754_create_country_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('country', [
            'identifier' => $this->string(36),
            'currency_code' => $this->string()->notNull(),
            'currency_name' => $this->string()->notNull(),
            'country_name' => $this->string()->notNull(),
            'country_code' => $this->string()->notNull(),
            'country_flag' => $this->text()->notNull()
        ]);



        $this->addPrimaryKey(
            'pk-country',
            'country',
            'identifier'
        );

        $this->createIndex(
            'idx-country-code',
            'country',
            'country_code',
            true // unique 
        );
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('country');
    }
}
