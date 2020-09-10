<?php

use yii\db\Migration;

/**
 * Class m200902_222207_init
 */
class m200902_222207_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('videos', [
            'id'        => $this->bigPrimaryKey(),
            'title'     => $this->string()->notNull(),
            'thumbnail' => $this->string(),
            'duration'  => $this->integer()->notNull(),
            'views'     => $this->integer()->notNull(),
            'added'     => $this->timestamp()->notNull()->defaultExpression('current_timestamp'),
        ]);

        $this->createIndex('idx_videos_views', 'videos', 'views');
        $this->createIndex('idx_videos_added', 'videos', 'added');
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropIndex('idx_videos_added', 'videos');
        $this->dropIndex('idx_videos_views', 'videos');
        $this->dropTable('videos');
    }
}
