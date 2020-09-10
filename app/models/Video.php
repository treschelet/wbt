<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property string $title
 * @property string|null $thumbnail
 * @property int $duration
 * @property int $views
 * @property string $added
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'duration', 'views'], 'required'],
            [['duration', 'views'], 'integer'],
            [['added'], 'safe'],
            [['title', 'thumbnail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'thumbnail' => 'Thumbnail',
            'duration' => 'Duration',
            'views' => 'Views',
            'added' => 'Added',
        ];
    }
}
