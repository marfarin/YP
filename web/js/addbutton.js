/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function addButton(element)
{
    var id = $(element).attr('id');
    
    var sys_id = $(element).attr('systemid');
    var valName = '#counter_'+sys_id+'';
    var val = $(valName).val();
    var name = 'Company['+sys_id+']['+(parseInt(val)-1)+']';
    var clone = document.getElementsByName(name);
    $(valName).val(parseInt(val) + 1);
    $('div#newlyaddedfields_'+sys_id+'').append(clone);
}
