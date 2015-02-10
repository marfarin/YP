/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addButton(element)
{
    var nameClassAddedField = $(element).attr('systemid');
    var counterAddedFieldName = '#counter_'+nameClassAddedField+'';
    var val = $(counterAddedFieldName).val();
    var inputTextClassFieldId = '#company-'+nameClassAddedField+'-'+(parseInt(val)-1);
    var classParentDivTextField = '.field-company-'+nameClassAddedField+'-'+(parseInt(val)-1);
    var clone  = $(classParentDivTextField).clone();
    clone.attr('class','form-group field-company-'+nameClassAddedField+'-'+(parseInt(val)));
    //var childrenClone = clone.jQuery(":first-child");
    clone.children(':first-child').attr('name', 'Company['+nameClassAddedField+']['+(parseInt(val))+']');
    clone.children(":first-child").attr('id', 'company-'+nameClassAddedField+'-'+(parseInt(val)));
    clone.children(":first-child").attr('value', '');
    clone.children(":first-child").val('');
    clone.appendTo('#div_'+nameClassAddedField);
    $(counterAddedFieldName).val(parseInt(val) + 1);
}
