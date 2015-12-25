<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%menu}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property integer $group_id
 * @property string $url
 * @property string $tabid
 * @property string $faicon
 * @property string $faicon_close
 * @property boolean $open
 * @property string $target
 *
 * @property Group $group
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%menu}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['pid', 'group_id'], 'integer'],
            [['open'], 'boolean'],
            [['name', 'tabid', 'faicon', 'faicon_close'], 'string', 'max' => 50],
            [['url'], 'string', 'max' => 100],
            [['target'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '文档ID'),
            'name' => Yii::t('app', '标题'),
            'pid' => Yii::t('app', '上级分类ID'),
            'group_id' => Yii::t('app', '分组ID'),
            'url' => Yii::t('app', '链接地址'),
            'tabid' => Yii::t('app', 'Tabid'),
            'faicon' => Yii::t('app', 'Faicon'),
            'faicon_close' => Yii::t('app', 'Faicon Close'),
            'open' => Yii::t('app', 'Open'),
            'target' => Yii::t('app', 'Target'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
