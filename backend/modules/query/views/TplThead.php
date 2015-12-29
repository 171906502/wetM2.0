<?php
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 17:09
 */
?>

<tr>
    <th align="center" width="50" nowrap>序号</th>
    <?php
        foreach($theadArray as $thead ){?>
        <th align="center" data-order-field= '<?php  if(isset($thead['reName'])){
            echo $thead['reName'];
        } else{
            echo $thead['fieldName'];
        }?>' > <?php echo $thead['fieldText']?> </th>
        <?php }?>
</tr>