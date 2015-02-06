/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addButton(element)
{
    var id = $(element).attr('id');
    
    var sys_id = $(element).attr('systemid');
    var val = $("'#counter_"+sys_id+"'").val();
    var name = "'.Company["+val+"]["+parseInt(val)+"]'";
    var clone = $(name).clone();
    $( "#counter_"+sys_id+"'" ).val( parseInt(val) + 1 );
    $( '"div#newlyaddedfields_'+val+'"' ).append( clone );
    
}
