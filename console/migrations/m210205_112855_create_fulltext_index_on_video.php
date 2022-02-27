<?php

use yii\db\Migration;

/**
 * Class m210205_112855_create_fulltext_index_on_video
 */
class m210205_112855_create_fulltext_index_on_video extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%video}} ADD FULLTEXT(title, description, tags)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210205_112855_create_fulltext_index_on_video cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210205_112855_create_fulltext_index_on_video cannot be reverted.\n";

        return false;
    }
    */
}
