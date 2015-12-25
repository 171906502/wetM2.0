<?php
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 17:09
 */
?>

<?php
$theadArray=[
    ["fieldText"=>"用户ID","fieldName"=>"id"],
    ["fieldText"=>"用户名","fieldName"=>"userName"],
    ["fieldText"=>"手机","fieldName"=>"phone"],
    ["fieldText"=>"电子邮箱","fieldName"=>"email"],
    ["fieldText"=>"用户状态","fieldName"=>"status"],
    ["fieldText"=>"创建时间","fieldName"=>"create_at"],
    ["fieldText"=>"更新时间","fieldName"=>"update_at"]
]
?>
<tr>
    <th align="center">序号</th>
    <?php
        foreach($theadArray as $thead ){?>
        <th align="center" data-order-field= '<?php echo $thead['fieldName']?>' > <?php echo $thead['fieldText']?> </th>
        <?php }?>
    <th align="center" width="26"><input type="checkbox" class="checkboxCtrl" data-group="ids" data-toggle="icheck"></th>
    <th align="center" width="100">操作</th>
</tr>