<?php
use yii\helpers\Url;
?>
<script type="text/javascript">
    $('#test-datagrid-json').datagrid({
        gridTitle : '',
        showToolbar: true,
        toolbarItem: 'all',
        addLocation:'last',
        local: 'remote',
        dataUrl: '<?= Url::toRoute(['loadtable'])?>&menuId=<?php echo $menuId?>',
        dataType: 'json',
        filterThead: false,
        columns: [
            {
                name: 'dbName',
                label: '数据库',
                type: 'string',
                align: 'center',
                width: 100
            },
            {
                name: 'tabName',
                label: '表名称',
                type: 'string',
                align: 'center',
                width: 100
            },
            {
                name: 'reName',
                label: '别名',
                type: 'string',
                align: 'center',
                width: 100
            },
            {
                name: 'isMain',
                label: '主表/副表',
                type: 'select',
                items: [{'2':'副表'}, {'1':'主表'}],
                align: 'center',
                width: 100,
                val:'2'

            },
            {
                name: 'condition',
                label: '连接条件',
                type: 'string',
                align: 'center',
                width: 300
            },
            {
                name: 'menuId',
                label: '',
                type: 'int',
                align: 'center',
                width: 100,
                hide:true
            },
            {
                name: 'id',
                label: '',
                type: 'int',
                align: 'center',
                width: 100,
                hide:true
            }
        ],
        editUrl: '<?= Url::toRoute(['tabcreate'])?>&menuId=<?php echo $menuId?>',
        saveAll:true,
        delUrl : '<?= Url::toRoute(['tabdelete'])?>&menuId=<?php echo $menuId?>',
        contextMenuB: true,
        paging: false,
        editMode: 'inline',
        fullGrid: true,
        showLinenumber: false,
        editCallback:function(json){
            var $datagrid = $('#test-datagrid-json');
            if ($.type(json) == 'array') {
                $datagrid.datagrid('refresh');
            } else if ($.type(json) == 'object') {
                if (json[BJUI.keys.statusCode]) {
                    if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
                        $datagrid.datagrid('refresh');
                    } else {
                        $datagrid.bjuiajax('ajaxDone', json)
                    }
                }
            }
        }
    })

</script>
<div class="bjui-pageContent">
    <div style="padding:15px; height:100%; width:100%;">
        <table id="test-datagrid-json" data-width="100%" data-height="100%" class="table table-bordered">
        </table>
    </div>
</div>
