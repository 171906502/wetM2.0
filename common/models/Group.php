<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $pid
 * @property string $url
 * @property string $tabid
 * @property string $faicon
 * @property string $faicon_close
 * @property string $menu_type
 * @property boolean $open
 * @property string $target
 * @property boolean $mask
 * @property integer $width
 * @property integer $height
 * @property string $divider
 * @property integer $status
 *
 * @property Menu[] $menus
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['pid', 'width', 'height', 'status'], 'integer'],
            [['open', 'mask'], 'boolean'],
            [['name', 'tabid', 'faicon', 'faicon_close', 'menu_type', 'divider'], 'string', 'max' => 50],
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
            'url' => Yii::t('app', '链接地址'),
            'tabid' => Yii::t('app', 'Tabid'),
            'faicon' => Yii::t('app', 'Faicon'),
            'faicon_close' => Yii::t('app', 'Faicon Close'),
            'menu_type' => Yii::t('app', 'Menu Type'),
            'open' => Yii::t('app', '折叠状态'),
            'target' => Yii::t('app', 'Target'),
            'mask' => Yii::t('app', 'Mask'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'divider' => Yii::t('app', 'Divider'),
            'status' => Yii::t('app', '是否启用'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroups()
    {
        return $this->hasMany(Group::className(), ['pid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['group_id' => 'id']);
    }
}