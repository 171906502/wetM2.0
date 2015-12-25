<?php

namespace backend\modules\core\models;

use Yii;
use common\models\User;
/**
 * UserForm represents the model behind the search form about `backend\modules\core\models\User`.
 */
class UserForm extends User
{
   
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '此用户名已被占用。', 'on'=>['create', 'update']],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '此邮件地址已被占用。', 'on'=>['create', 'update']],
        ];
    }
    
    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['username' , 'email', 'status'];
        $scenarios['update'] = ['username' , 'email', 'status'];
        $scenarios['search'] = ['id', 'username', 'email', 'status'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function search($params)
    {
        $query = $this::find()->orderBy('created_at desc');
        $this->attributes = $params;
        if (!$this->validate()) {
            return $query;
        }
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
//             'created_at' => $this->created_at,
//             'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email]);
        return $query;
    }
}
