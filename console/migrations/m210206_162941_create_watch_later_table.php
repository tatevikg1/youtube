<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%watch_later}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%video}}`
 */
class m210206_162941_create_watch_later_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%watch_later}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'video_id' => $this->string(16),
            'created_at' => $this->integer(11),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-watch_later-user_id}}',
            '{{%watch_later}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-watch_later-user_id}}',
            '{{%watch_later}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `video_id`
        $this->createIndex(
            '{{%idx-watch_later-video_id}}',
            '{{%watch_later}}',
            'video_id'
        );

        // add foreign key for table `{{%video}}`
        $this->addForeignKey(
            '{{%fk-watch_later-video_id}}',
            '{{%watch_later}}',
            'video_id',
            '{{%video}}',
            'video_id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-watch_later-user_id}}',
            '{{%watch_later}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-watch_later-user_id}}',
            '{{%watch_later}}'
        );

        // drops foreign key for table `{{%video}}`
        $this->dropForeignKey(
            '{{%fk-watch_later-video_id}}',
            '{{%watch_later}}'
        );

        // drops index for column `video_id`
        $this->dropIndex(
            '{{%idx-watch_later-video_id}}',
            '{{%watch_later}}'
        );

        $this->dropTable('{{%watch_later}}');
    }
}
