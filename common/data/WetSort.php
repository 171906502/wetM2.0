<?php
namespace common\data;
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2016/1/20
 * Time: 16:10
 */
use Yii;
use yii\data\Sort;
use yii\web\Request;


class WetSort extends Sort
{
    public $sortParam = 'orderField';
    public $orderDirection = 'orderDirection';
    /**
     * @var array the currently requested sort order as computed by [[getAttributeOrders]].
     */
    private $_attributeOrders;
    /**
     * Returns the currently requested sort information.
     * @param boolean $recalculate whether to recalculate the sort directions
     * @return array sort directions indexed by attribute names.
     * Sort direction can be either `SORT_ASC` for ascending order or
     * `SORT_DESC` for descending order.
     * 重写yii的排序判断
     */
    public function getAttributeOrders($recalculate = false)
    {
        if ($this->_attributeOrders === null || $recalculate) {
            $this->_attributeOrders = [];
            if (($params = $this->params) === null) {
                $request = Yii::$app->getRequest();
                $params = $request instanceof Request ? $request->getQueryParams() : [];
            }
            if (isset($params[$this->sortParam]) && isset($params[$this->orderDirection]) && is_scalar($params[$this->sortParam])) {
                $attributes = explode($this->separator, $params[$this->sortParam]);
                foreach ($attributes as $attribute) {
                    $descending = false;
                    if (strncmp($attribute, '-', 1) === 0) {
                        $descending = true;
                        $attribute = substr($attribute, 1);
                    }
                    if($params[$this->orderDirection]=='desc'){
                        $descending = true;
                    }

                    if (isset($this->attributes[$attribute])) {
                        $this->_attributeOrders[$attribute] = $descending ? SORT_DESC : SORT_ASC;
                        if (!$this->enableMultiSort) {
                            return $this->_attributeOrders;
                        }
                    }
                }
            }
            if (empty($this->_attributeOrders) && is_array($this->defaultOrder)) {
                $this->_attributeOrders = $this->defaultOrder;
            }
        }

        return $this->_attributeOrders;
    }


}