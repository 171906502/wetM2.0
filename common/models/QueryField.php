<?php

namespace common\models;

use Yii;


class QueryField extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%query_field}}';
    }

    public function getQueryTable()
    {

        return $this->hasOne(QueryTable::className(), ['id' => 'tabId']);
    }
}
