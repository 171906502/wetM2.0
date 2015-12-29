<?php

namespace common\models;

use Yii;


class QueryTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%query_table}}';
    }


}
