<?php
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 17:11
 */
?>

<?php $rowNumber = 1?>
<?php foreach ($models as $model) {?>
    <tr data-id="<?= $model['id'] ?>">
        <td align="center"  class="datagrid-linenumber-td"><div><?php echo $rowNumber?></div></td>
        <?php
            foreach($theadArray as $thead){ ?>
               <?php if(isset($model[$thead['fieldName']])){?>
                    <td><? echo $model[$thead['fieldName']]?></td>
                     <?php }else{
                    echo "<td></td>";
                }
                ?>
            <?php
                }?>
    </tr>
    <?php $rowNumber= $rowNumber+1?>

<?php }?>
<?php $rowNumber = 1?>
