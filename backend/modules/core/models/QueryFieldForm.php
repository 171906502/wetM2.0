<?php

namespace backend\modules\core\models;

use Yii;
use common\models\QueryField;
/**
 */
class QueryFieldForm extends QueryField
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

        ];
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['tabId','fieldText', 'fieldName', 'dataType', 'menuId','gridNumber','isQuery','reName','makeTbName'];
        $scenarios['update'] = ['tabId','fieldText', 'fieldName', 'dataType', 'menuId','gridNumber','isQuery','reName','makeTbName'];
        $scenarios['search'] = ['tabId','fieldText', 'fieldName', 'dataType', 'menuId','gridNumber','isQuery','reName','makeTbName'];
        return $scenarios;
    }
    /**
     * @inheritdoc
     */
    public function search($params)
    {
        $query = $this::find()->orderBy('gridNumber asc');
        $this->attributes = $params;
        if (!$this->validate()) {
            return $query;
        }
        return $query;
    }
}
