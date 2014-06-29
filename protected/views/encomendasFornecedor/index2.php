<?php
/**
 * Created by PhpStorm.
 * User: sapc
 * Date: 12/04/14
 * Time: 23:41
 */

?>
<table id="list4">
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>

<script>

    var mydata1 = <?php $this->renderPartial("indexUrl", array("rows"=>$rows));?>;


    $("#list4").jqGrid({
        data: mydata1,
        datatype: "local",
        colNames:['Id','Data','Fornecedor','Estado'],
        colModel:[
            {name:'id',index:'id', width:55, editable:true, sorttype:'int'},
            {name:'data',index:'data', width:90},
            {name:'fornecedor',index:'name', width:100},
            {name:'estado',index:'estado', width:80, align:"right"}
        ],
        rowNum:30,
        rowList:[10,20,30],
        height: 'auto',
        pager: '#list4',
        sortname: 'fornecedor',
        viewrecords: true,
        sortorder: "desc",
        caption:"",
        grouping: true,
        /*groupingView : {
            groupField : ['fornecedor']
        }*/

    });
    $("#list4").jqGrid('navGrid','#list4',{add:false,edit:false,del:false});


</script>