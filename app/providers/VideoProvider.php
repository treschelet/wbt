<?php


namespace app\providers;


use app\models\Video;
use yii\base\InvalidConfigException;
use yii\data\BaseDataProvider;
use yii\db\Connection;
use yii\di\Instance;

class VideoProvider extends BaseDataProvider
{
    /**
     * @var Connection|array|string the DB connection object or the application component ID of the DB connection.
     * Starting from version 2.0.2, this can also be a configuration array for creating the object.
     */
    public $db = 'db';

    /**
     * Initializes the DB connection component.
     * This method will initialize the [[db]] property to make sure it refers to a valid DB connection.
     * @throws InvalidConfigException if [[db]] is invalid.
     */
    public function init()
    {
        parent::init();
        $this->db = Instance::ensure($this->db, Connection::className());
    }

    protected function prepareModels()
    {
        $table = Video::tableName();
        $order = '';
        $pages = '';
        if (($pagination = $this->getPagination()) !== false) {
            $pagination->totalCount = $this->getTotalCount();
            if ($pagination->totalCount === 0) {
                return [];
            }

            $start = $pagination->getOffset() + 1;
            $stop = $start + $pagination->getLimit() - 1;
            $pages = "WHERE rn BETWEEN $start AND $stop";
        }

        if (($sort = $this->getSort()) !== false) {
            $sortOrders = $sort->getOrders();
            $orders = [];
            foreach ($sortOrders as $attribute => $direction) {
                $orders[] = $attribute.($direction === SORT_ASC ? ' ASC' : ' DESC');
            }
            if (!empty($orders)) {
                $order = 'ORDER BY ' . implode(',', $orders);
            }
        }

        $sql = "SELECT * FROM (SELECT $table.*, row_number() over ($order) rn FROM $table) v $pages $order";

        return Video::findBySql($sql)->all();

            //$this->db->createCommand($sql)->queryAll();
    }

    protected function prepareKeys($models)
    {
        $keys = [];
        $pks = Video::primaryKey();
        if (count($pks) === 1) {
            $pk = $pks[0];
            foreach ($models as $model) {
                $keys[] = $model[$pk];
            }
        } else {
            foreach ($models as $model) {
                $kk = [];
                foreach ($pks as $pk) {
                    $kk[$pk] = $model[$pk];
                }
                $keys[] = $kk;
            }
        }

        return $keys;
    }

    protected function prepareTotalCount()
    {
        return (int) $this->db->createCommand(
            'SELECT n_live_tup FROM pg_stat_all_tables WHERE relname=:relname',
            [':relname' => Video::tableName()]
        )->queryScalar();
    }
}