<?php

use yii\db\Migration;

/**
 * Class m210817_185847_seed_team_table
 */
class m210817_185847_seed_team_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insertFakeTeams();
    }

    private function insertFakeTeams()
    {
        $faker = \Faker\Factory::create();

        for($i=0; $i<=10; $i++) {
            $this->insert('teams',['name' => $faker->name]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210817_185847_seed_team_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210817_185847_seed_team_table cannot be reverted.\n";

        return false;
    }
    */
}
