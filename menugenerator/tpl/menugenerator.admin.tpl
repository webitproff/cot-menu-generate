<!-- BEGIN: MAIN -->
<div class=" button-toolbar block">
        <a href="{PHP.db_menugenerator|cot_url('admin', 'm=extrafields&n=$this')}" class="button">{PHP.L.adm_extrafields_desc}</a>
</div>
<script type="text/javascript">
    var qid={PHP.local_max};
    function removemenugenerator(object)
    {
        var objectparent = $(object).parent();
        objectparent = $(objectparent).parent();
        $(objectparent).find('.item_title').attr('value', '');
        $(objectparent).hide();
        return false;
    }

    $(document).ready(function(){
        $("#mg_new").hide();

        $("#addoption").click(function () {
            var object = $('#mg_new').clone().attr("id", 'mg_'+qid);

            $(object).find('.item_id').attr('name', 'item_id['+qid+']');
            $(object).find('.item_title').attr('name', 'item_title['+qid+']');
            $(object).find('.item_href').attr('name', 'item_href['+qid+']');
            $(object).find('.item_desc').attr('name', 'item_desc['+qid+']');
            $(object).find('.item_path').attr('name', 'item_path['+qid+']');
            $(object).find('.item_users').attr('name', 'item_users['+qid+']');

            $(object).insertBefore('#mg_new').show();
            qid++;
        });
        $("#menugeneratorbefore").show();
//        if(ident < 2)
//        {$("#addoption").click();}

    });
</script>

<!-- BEGIN: GENERAL -->
<form action="{MENU_FORMACTION}" method="post" name="general">
    <table id="menugenerator" class="cells">
        <tr class="nodrag nodrop">
            <td class="coltop width5" style="text-align:right;">{PHP.L.Path}</td>
            <td class="coltop width30">{PHP.L.mg_title}</td>
            <td class="coltop width20">{PHP.L.mg_href}</td>           
            <td class="coltop width20">{PHP.L.mg_desc}</td>
            <td class="coltop width10">{PHP.L.mg_extra}</td>
			<td class="coltop width10">{PHP.L.mg_users}</td>
            <td class="coltop width5"></td>
        </tr>
        <!-- BEGIN: ITEMS  -->
        <tr id="mg_{MENU_ITEM_ID}">

            <td style="text-align:right;">{MENU_ITEM_PATH}</td>
            <td>{MENU_ITEM_LEVELC}{MENU_ITEM_TITLE}</td>

            <td>{MENU_ITEM_HREF}</td>
            <td>{MENU_ITEM_DESC}</td>
			<td>{MENU_ITEM_EXTRA}</td>
            <td>{MENU_ITEM_USERS}</td>
            <td><input  name='addoption' value='{PHP.L.Delete}' onclick='removemenugenerator(this)' type='button' /></td>
        </tr>
        <!-- END: ITEMS -->
        <tr id="menugeneratorbefore" class="nodrag nodrop" style="display:none;"><td colspan='7'>
                <input  name="addoption" value="{PHP.L.Add}" id="addoption" type="button" class="button special" />
            </td></tr>
    </table>
    <div class="centerall"><input class="button confirm large" type="submit"  value="{PHP.L.Update_menu}" /></div>
	
	    <p style="padding:10px;">{PHP.L.Tags}: {MENU_MENU_SET}. {PHP.L.mg_example}</p>
</form>
<!-- END: GENERAL -->

<!-- BEGIN: HELP -->

<!-- END: HELP -->

<!-- END: MAIN -->
