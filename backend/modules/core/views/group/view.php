<?php
use yii\helpers\Url;
$pid = Yii::$app->request->get('pid',$model->pid);
if(empty($pid)) $pid=0;
?>
<div class="bjui-pageContent">
    <form action="<?= Url::toRoute([$model->id?'update':'create','id'=>$model->id]) ?>" id="core-group-view-form" data-toggle="validate" data-alertmsg="false" data-callback="myCallback">
        <input type="hidden" id="pid" name="pid" value="<?= $pid; ?>">
        <input type="hidden" id="tId" value="<?= $model->id?Yii::$app->request->get('tId'):'' ?>">
        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
        <table class="table table-condensed table-hover" width="100%">
            <tbody>
                <tr>
                    <td>
                        <label for="name" class="control-label x120">菜单名称：</label>
                        <input type="text" class="required" name="name" id="name" value="<?= $model->name; ?>" data-rule="required" size="20">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="name" class="control-label x120">字体图标：</label>
                        <input type="text" name="faicon" id="faicon" value="<?= $model->faicon; ?>" size="15" placeholder="折叠前">
                        <input type="text" name="faicon_close" id="faicon_close" value="<?= $model->faicon_close; ?>" size="15"placeholder="折叠后">
                    </td>
                </tr>
                <?php if(!$pid){?>
                <tr>
                    <td>
                        <label for="target" class="control-label x120">菜单类型：</label>
                        <select class="selectpicker show-tick" name="menu_type" id="menu_type" data-style="btn-default btn-sel" data-width="auto">
                            <option value="ztree" <?= $model->menu_type=='ztree'?' selected="selected"':''; ?>>zTree菜单</option>
                            <option value="dropdown" <?= $model->menu_type=='dropdown'?' selected="selected"':''; ?>>下拉菜单</option>
                        </select>
                    </td>
                </tr>
                <?php }else{?>
                <tr>
                    <td>
                        <label for="url" class="control-label x120">URL：</label>
                        <input type="text" class="form-control" name="url" id="url" value="<?= $model->name; ?>" size="30" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="target" class="control-label x120">工作区：</label>
                        <select class="selectpicker show-tick" name="target" id="target" data-style="btn-default btn-sel" data-width="auto">
                            <option value="navtab" <?= $model->target=='navtab'?' selected="selected"':''; ?>>标签工作区</option>
                            <option value="dialog" <?= $model->target=='dialog'?' selected="selected"':''; ?>>弹窗工作区</option>
                            <option value="_blank" <?= $model->target=='_blank'?' selected="selected"':''; ?>>新窗口</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tabid" class="control-label x120">工作区ID：</label>
                        <input type="text" class="form-control" name="tabid" id="tabid" value="<?= $model->tabid; ?>" size="20" placeholder="" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="open" class="control-label x120">菜单状态：</label>
                        <select class="selectpicker show-tick" name="open" id="open" data-style="btn-default btn-sel" data-width="auto">
                            <option value="0" <?= $model->open==0?' selected="selected"':''; ?>>折叠</option>
                            <option value="1" <?= $model->open==1?' selected="selected"':''; ?>>展开</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tabid" class="control-label x120">插入分割线：</label>
                        <input type="radio" name="divider" id="divider1" data-toggle="icheck" data-label="在前" value="before" <?= $model->divider=='before'?' checked="checked"':''; ?>>
                        <input type="radio" name="divider" id="divider2" data-toggle="icheck" data-label="在后" value="after" <?= $model->divider=='after'?' checked="checked"':''; ?>>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li>
            <button type="button" class="btn-close" data-icon="close">取消</button>
        </li>
        <li>
            <button type="submit" class="btn-default" data-icon="save">保存</button>
        </li>
    </ul>
</div>
