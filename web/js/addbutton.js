/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addButton(element)
{
    var nameClassAddedField = $(element).attr('systemid');
    var nameClassAddedFieldLower = nameClassAddedField.toLowerCase();
    var counterAddedFieldName = '#counter_'+nameClassAddedFieldLower+'';
    var val = $(counterAddedFieldName).val();
    var inputTextClassFieldId = '#company-'+nameClassAddedField+'-'+(parseInt(val)-1);
    var classParentDivTextField = '.field-company-'+nameClassAddedFieldLower+'-'+(parseInt(val)-1);
    var clone  = $(classParentDivTextField).clone(true);
    var crc32 = $(inputTextClassFieldId).attr('crc32');
    clone.attr('class','form-group field-company-'+nameClassAddedFieldLower+'-'+(parseInt(val)));
    //var childrenClone = clone.jQuery(":first-child");
    clone.children("input[id]").attr('name', 'Company['+nameClassAddedField+']['+(parseInt(val))+']');
    clone.children("input[id]").attr('id', 'company-'+nameClassAddedFieldLower+'-'+(parseInt(val)));
    clone.children("input[id]").attr('value', '');
    clone.children("input[id]").val('');
    var m32 = clone.children("input[id]");
    clone.appendTo('#div_'+nameClassAddedFieldLower);
    
    jQuery(document).ready(function() {
        $('#company-'+nameClassAddedField+'-'+(parseInt(val))).inputmask(window['inputmask_'+crc32]);
    });
    //$('#company-'+nameClassAddedField+'-'+(parseInt(val))).inputmask(inputmask_)
    
    $(counterAddedFieldName).val(parseInt(val) + 1);

}


function addMultipleButton(element)
{
    var nameClassAddedField = $(element).attr('systemid');
    var nameClassAddedFieldLower = nameClassAddedField.toLowerCase();
    var counterAddedFieldName = '#counter_'+nameClassAddedFieldLower+'';
    var val = $(counterAddedFieldName).val();
    var inputTextClassFieldId = '#company-'+nameClassAddedField+'-'+(parseInt(val)-1);
    var classParentDivTextField = '.field-company-'+nameClassAddedFieldLower+'-'+(parseInt(val)-1);
    var parentDiv = document.createElement("div");
    parentDiv.className = "form-group field-company-"+nameClassAddedFieldLower+"-"+(parseInt(val))+" required";
    var divKvPlugin = document.createElement("div");
    divKvPlugin.className = "kv-plugin-loading loading-company-"+nameClassAddedFieldLower+"-"+(parseInt(val));
    divKvPlugin.innerHTML = "&nbsp;";
    var input = document.createElement("input");
    input.className = "form-control kv-hide input-md";
    input.id = "company-"+nameClassAddedFieldLower+"-"+(parseInt(val));
    input.type = "text";
    input.name = "Company["+nameClassAddedField+"]["+(parseInt(val))+"]";
    input.value = "";
    input.style = "width:100%";
    input.setAttribute("placeholder", "Поиск родительских компаний");
    input.setAttribute("data-krajee-select2", "select2_00a376fa");
    var help = document.createElement("div");
    help.className = "help-block";
    if(classParentDivTextField === '.field-company-parentid-'+(parseInt(val)-1)) {
        parentDiv.appendChild(divKvPlugin);
        parentDiv.appendChild(input);
        parentDiv.appendChild(help);
        //$('#div_'+classParentDivTextField).appendChild(parentDiv);
        $('#div_'+nameClassAddedFieldLower).append(parentDiv);
        $(counterAddedFieldName).val(parseInt(val) + 1);
        jQuery(document).ready(function() {
            jQuery.when(jQuery('#company-'+nameClassAddedFieldLower+'-'+(parseInt(val))).select2(select2_00a376fa)).done(initSelect2Loading('company-'+nameClassAddedFieldLower +'-'+(parseInt(val))));
            jQuery('#company-'+nameClassAddedFieldLower+'-'+(parseInt(val))).on('select2-open', function(){initSelect2DropStyle('company-'+nameClassAddedFieldLower+'-'+(parseInt(val)))});
        });
    }
}