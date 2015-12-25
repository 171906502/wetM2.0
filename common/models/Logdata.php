<?php

namespace common\models;

use Yii;


class Logdata extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%logdata}}';
    }
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['data','logFile','remoteIp'];
        $scenarios['update'] = ['data','logFile','remoteIp'];
        $scenarios['search'] = ['id', 'data'];
        return $scenarios;
    }



    /**
     * @inheritdoc
     */
    public function search($params)
    {
        $query = $this::find();
        $this->attributes = $params;
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
//        $query->andFilterWhere(['like', 'username', $this->username])
//            ->andFilterWhere(['like', 'mobile', $this->mobile])
//            ->andFilterWhere(['like', 'email', $this->email]);
        return $query;
    }
}
