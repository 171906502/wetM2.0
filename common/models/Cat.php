<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cat}}".
 *
 * @property integer $cid
 * @property integer $parent_cid
 * @property integer $gid
 * @property string $cname
 * @property integer $is_parent
 * @property integer $cityid
 * @property string $status
 * @property integer $sort
 * @property integer $type
 * @property string $query
 */
class Cat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_cid', 'cname'], 'required'],
            [['parent_cid', 'gid', 'is_parent', 'cityid', 'sort', 'type'], 'integer'],
            [['query'], 'string'],
            [['cname'], 'string', 'max' => 50],
            [['status'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cid' => Yii::t('app', '分类ID'),
            'parent_cid' => Yii::t('app', '分类父ID'),
            'gid' => Yii::t('app', '分组ID'),
            'cname' => Yii::t('app', '分类名称'),
            'is_parent' => Yii::t('app', '是否是父节点'),
            'cityid' => Yii::t('app', '城市ID'),
            'status' => Yii::t('app', '状态'),
            'sort' => Yii::t('app', '排序'),
            'type' => Yii::t('app', '类型'),
            'query' => Yii::t('app', '查询语句'),
        ];
    }
}
