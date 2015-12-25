<?php
/**
 * Created by PhpStorm.
 * User: cntway
 * Date: 2015/11/5
 * Time: 17:10
 */
?>

<?php
    foreach($theadArray as $thead) {
        if ($thead['isQuery'] == 1) {
            ?>
            <label><?php echo $thead['fieldText']?>:</label>
            <input type="text" value="<?php echo Yii::$app->request->get($thead['fieldName']) ?>"
                   name=<?php echo $thead['fieldName']?> class="form-control" size="10">
        <?php
        }
    }?>