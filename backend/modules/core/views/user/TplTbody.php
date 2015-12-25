<?php
use yii\helpers\Url;
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 17:11
 */
?>

<?php
$theadArray=[
    ["fieldText"=>"用户ID","fieldName"=>"id"],
    ["fieldText"=>"用户名","fieldName"=>"username"],
    ["fieldText"=>"手机","fieldName"=>"mobile"],
    ["fieldText"=>"电子邮箱","fieldName"=>"email"],
    ["fieldText"=>"用户状态","fieldName"=>"status"],
    ["fieldText"=>"创建时间","fieldName"=>"created_at"],
    ["fieldText"=>"更新时间","fieldName"=>"updated_at"]
]
?>
<?php $rowNumber = 1?>
<?php foreach ($models as $model) {?>
    <tr data-id="<?= $model->id ?>">
        <td align="center" class="datagrid-linenumber-td"><div><?php echo $rowNumber?></div></td>

        <?php
            foreach($theadArray as $thead){ ?>
                <td><? eval('echo $model->'.$thead['fieldName'].';');  ?></td>
            <?php
                }?>

<!--        <td>--><?//= $model->id ?><!--</td>-->
<!--        <td>--><?//= $model->username ?><!--</td>-->
<!--        <td>--><?//= $model->mobile ?><!--</td>-->
<!--        <td>--><?//= $model->email ?><!--</td>-->
<!--        <td align="center">--><?//= Yii::$app->params['status'][$model->status] ?><!--</td>-->
<!--        <td>--><?//= date('Y-m-d H:i:s',$model->created_at) ?><!--</td>-->
<!--        <td>--><?//= date('Y-m-d H:i:s',$model->updated_at) ?><!--</td>-->


        <td align="center">
            <input type="checkbox" name="ids" data-toggle="icheck" value="<?= $model->id ?>">
        </td>
        <td>
            <a href="<?= Url::toRoute(['views', 'id' => $model->id]) ?>" class="btn btn-green" data-toggle="dialog" data-id="core-user-view" data-title="编辑用户-<?= $model->username ?>" data-reload-warn="本页已有打开的内容，确定将刷新本页内容，是否继续？">编辑</a>
            <a href="<?= Url::toRoute(['delete', 'id' => $model->id]) ?>" class="btn btn-red" data-toggle="doajax" data-data="_csrf=<?= Yii::$app->request->csrfToken ?>" data-confirm-msg="确定要删除该行信息吗？">删</a>
        </td>
    </tr>
    <?php $rowNumber= $rowNumber+1?>

<?php }?>
<?php $rowNumber = 1?>
