<?php

use yii\db\Migration;

/**
 * Class m210811_222636_seed_member_table
 */
class m210811_222636_seed_member_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeMembers();
    }

    private function insertFakeMembers()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<10; $i++) {
            $this->insert(
                'member', ['name' => $faker->name]
            );
        }
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210811_222636_seed_member_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210811_222636_seed_member_table cannot be reverted.\n";

        return false;
    }
    */
}
