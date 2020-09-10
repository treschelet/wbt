<?php

use yii\db\Migration;

/**
 * Class m200908_082747_fill_videos
 */
class m200908_082747_fill_videos extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            INSERT INTO videos(title, thumbnail, duration, views, added)
            SELECT
                md5(random()::text) as title,
                'https://via.placeholder.com/150x150?text=Thumbnail+Image' as thumbnail,
                floor(random()*7200)::int as duration,
                floor(random()*1000000)::int as views,
                NOW() - (random() * (NOW()+'90 days' - NOW())) as added
            FROM generate_series(1,1000) s
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('videos');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200908_082747_fill_videos cannot be reverted.\n";

        return false;
    }
    */
}
