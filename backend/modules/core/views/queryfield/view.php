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
        dataUrl: '<?= Url::toRoute(['loadfield'])?>&menuId=<?php echo $menuId?>',
        dataType: 'json',
        filterThead: false,
        columns: [

            {
                name: 'fieldText',
                label: '显示名称',
                type: 'string',
                align: 'center',
                width: 150
            },
            {
                name: 'dataType',
                label: '数据类型',
                type: 'select',
                items: [{'1':'int'}, {'2':'number'}, {'3':'string'}, {'4':'date'}],
                align: 'center',
                width: 100,
                val:'2'

            },
            {
                name: 'isQuery',
                label: '查询条件',
                type: 'select',
                items: [{'2':'否'},{'1':'是'}],
                align: 'center',
                width: 100,
                val:'2'

            },
            {
                name: 'tabId',
                label: '表明称',
                type: 'select',
                align: 'center',
                items:[<?php echo json_encode($items)?>],
                width: 150
            },
            {
                name: 'fieldName',
                label: '字段名称',
                type: 'string',
                align: 'center',
                width: 100
            },
            {
                name: 'reName',
                label: '重命名',
                type: 'string',
                align: 'center',
                width: 100
            },
            {
                name: 'makeTbName',
                label: '生成表名',
                type: 'select',
                items: [{'1':'是'},{'2':'否'}],
                align: 'center',
                width: 100
            },
            {
                name: 'menuId',
                label: '',
                type: 'int',
                align: 'center',
                width: 100,
                hide:true
            }
        ],
        editUrl: '<?= Url::toRoute(['create'])?>&menuId=<?php echo $menuId?>',
        saveAll:true,
        delUrl : '<?= Url::toRoute(['deletefield'])?>&menuId=<?php echo $menuId?>',
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
