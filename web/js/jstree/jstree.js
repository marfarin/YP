$(document).ready(function()
{
	var clicks = 0;
	var pagerLimit = 2; //колличество страниц в пагинаторе
	var pageSize = 100; // колличество элементов до вывода пагинации
	
	var ajaxUrl = $('#pageTree').attr('url')+'/';
	
	function editTreeObject(obj)
	{
        window.location.href = "update/"+obj.attr('id');
		//window.open("update/"+obj.attr('id'),'_blank');
//		$.ajax({
//			  url: "update/"+obj.attr('id'),
//			  cache: false,
//			  success: function(html){
//			    $("#PageModification").html(html);
//			    $("#PageModification").dialog("open");
//			    $('.editor').redactor();
//			    $('#Page_type_id').change();
//			  }
//			});
	}
	
	function deleteChildsObject(obj)
	{
		if (confirm("Вы уверены, что хотите удалить дочерние элементы")) {
			$.ajax({
				  url: "deleteChilds/"+obj.attr('id'),
				  cache: false,
				  type: "POST",
				  success: function(html){
					  if(parseInt(html) > 0)
						  alert('Удалено ' + html + ' объектов');
					  else
						  alert(html);
				  }
			});
		}
		else
			$.jstree.rollback(data.rlbk);
	}
	
	function moveTreeObject(obj,direction)
	{
		console.log(obj);
	}
	
	

	function renderTreePager(node){
		page = Number($(node).attr('page'));
		pageCount = Number($(node).attr('pagecount'));
		delta = Math.ceil(pagerLimit/2);
		min = page - delta > 0 ? page - delta : 1;
		max = page + delta < pageCount ? page + delta : pageCount;
		
		pager = $("<span class='treepager'></span>");
		if (page >= delta+2)
		{
			separator = '..';
			if (page == delta+2)
				separator = '';
			pager.append("<span>1</span>"+separator);
		}

		
		for (i = min ;i <= max ;  i++)
		{
			curPage = i;
			htmlClass = curPage == page ? 'current' : '';
			pager.append("<span class='"+htmlClass+"'>"+(curPage)+"</span>");
		}

		if (page <= (pageCount - delta -1))
		{
			separator = '..';
			if (page == (pageCount - delta -1))
				separator = '';
			pager.append(separator+"<span>"+pageCount+"</span>");
		}
		
		return pager;
	};
	
	
	$("#pageTree").jstree({
	    "plugins" : [ "themes", "json_data", "ui", "crrm", "cookies", "dnd", "types", "hotkeys", "contextmenu" ],
	    "core" : {
	        "animation" : 300
	    },
	    "json_data" : {
	        "ajax" : {
	            // the URL to fetch the data
	            "url" : ajaxUrl+"ajaxTree/getChildren",
	            "data" : function (n) { 
	                return { 
	                    "parent_id" : n.attr ? n.attr("id") : 1 ,
						"page" : n.attr ? n.attr("page") : 1 ,
						"pageSize" : pageSize ,
	                }; 
	            },
	    		"success" : function(response) {
	    			if (response.errorCode)
	    				alert(response.message);
	    		}
	        }
	        
	    },
	    "themes" : {
	        "theme" : "apple",
	    },
	    "dnd" : {
	    	"open_timeout" : 2000,
	    	
	    },
	    "types" : {
	        "valid_children" : [],
	        "max_depth" : -2,
	        "max_children" : -2,
	        "types" : {
	            "readonly" : {
	                "delete_node" : false,
	                "icon" : {"image" : "readonly.png"},
	            }
	        }
	    },
	    "contextmenu" : {
	    	"items" : {
	    		"ccp" : false,
	    		"rename" : false,
		    	"create" : {
		    		"label"				: "Создать",
		    		// The function to execute upon a click
		    		"action"			: function (obj) { this.create(obj, 'first',{},'',true ); },
		    		// All below are optional 
		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		"_class"			: "class",	// class is applied to the item LI node
		    		"separator_before"	: false,	// Insert a separator before the item
		    		"separator_after"	: false,		// Insert a separator after the item
		    		// false or string - if does not contain `/` - used as classname
		    		"icon"				: false,
		    		//"submenu"			: { 
		    			/* Collection of objects (the same structure) */
		    		//}
		    	},
			    "edit" : {
		    		"label"				: "Редактировать",
		    		// The function to execute upon a click
		    		"action"			: function (obj) { editTreeObject(obj); },
		    		// All below are optional 
		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		"_class"			: "class",	// class is applied to the item LI node
		    		"separator_before"	: false,	// Insert a separator before the item
		    		"separator_after"	: false,		// Insert a separator after the item
		    		// false or string - if does not contain `/` - used as classname
		    		"icon"				: false,
		    		//"submenu"			: { 
		    			/* Collection of objects (the same structure) */
		    		//}
		    	},
		    	"remove" : {
		    		"label"				: "Удалить",
		    		// The function to execute upon a click
		    		"action"			: function (obj) { this.remove(obj); },
		    		// All below are optional 
		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		"_class"			: "class",	// class is applied to the item LI node
		    		"separator_before"	: false,	// Insert a separator before the item
		    		"separator_after"	: false,		// Insert a separator after the item
		    		// false or string - if does not contain `/` - used as classname
		    		"icon"				: false,
		    		//"submenu"			: { 
		    			/* Collection of objects (the same structure) */
		    		//}
		    	},
		    	"removeChilds" : {
		    		"label"				: "Удалить дочерние",
		    		// The function to execute upon a click
		    		"action"			: function (obj) { deleteChildsObject(obj);  },
		    		// All below are optional 
		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		"_class"			: "class",	// class is applied to the item LI node
		    		"separator_before"	: false,	// Insert a separator before the item
		    		"separator_after"	: false,		// Insert a separator after the item
		    		// false or string - if does not contain `/` - used as classname
		    		"icon"				: false,
		    		//"submenu"			: { 
		    			/* Collection of objects (the same structure) */
		    		//}
		    	}
/*		    	"move" : {
		    		"label"				: "Передвинуть",
		    		// The function to execute upon a click
		    		// All below are optional 
		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		"_class"			: "class",	// class is applied to the item LI node
		    		"separator_before"	: false,	// Insert a separator before the item
		    		"separator_after"	: false,		// Insert a separator after the item
		    		// false or string - if does not contain `/` - used as classname
		    		"icon"				: false,
		    		"submenu"			: { 
		    				"up" : {
		    					"label"				: "Вверх",
		    					"action"			: function (obj) { moveTreeObject(obj,1); },
		    		    		// The function to execute upon a click
		    		    		// All below are optional 
		    		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		    		"_class"			: "class",	// class is applied to the item LI node
		    		    		"separator_before"	: false,	// Insert a separator before the item
		    		    		"separator_after"	: false,		// Insert a separator after the item
		    		    		// false or string - if does not contain `/` - used as classname
		    		    		"icon"				: false,
		    				},
		    				"down" : {
		    					"label"				: "Вниз",
		    					"action"			: function (obj) { moveTreeObject(obj,2); },
		    		    		// The function to execute upon a click
		    		    		// All below are optional 
		    		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		    		"_class"			: "class",	// class is applied to the item LI node
		    		    		"separator_before"	: false,	// Insert a separator before the item
		    		    		"separator_after"	: false,		// Insert a separator after the item
		    		    		// false or string - if does not contain `/` - used as classname
		    		    		"icon"				: false,
		    				},
		    				"under" : {
		    					"label"				: "Под ...",
		    					"action"			: function (obj) { moveTreeObject(obj,2); },
		    		    		// The function to execute upon a click
		    		    		// All below are optional 
		    		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		    		"_class"			: "class",	// class is applied to the item LI node
		    		    		"separator_before"	: false,	// Insert a separator before the item
		    		    		"separator_after"	: false,		// Insert a separator after the item
		    		    		// false or string - if does not contain `/` - used as classname
		    		    		"icon"				: false,
		    				},
		    				"down" : {
		    					"label"				: "Вниз",
		    					"action"			: function (obj) { moveTreeObject(obj,2); },
		    		    		// The function to execute upon a click
		    		    		// All below are optional 
		    		    		"_disabled"			: false,		// clicking the item won't do a thing
		    		    		"_class"			: "class",	// class is applied to the item LI node
		    		    		"separator_before"	: false,	// Insert a separator before the item
		    		    		"separator_after"	: false,		// Insert a separator after the item
		    		    		// false or string - if does not contain `/` - used as classname
		    		    		"icon"				: false,
		    				}
		    				
		    		}
		    	}*/
	    	}
	    }
	})
	.bind("create.jstree", function (e, data) {
		window.open($('input[name="objectPath"]').val()+"/0/"+data.rslt.parent.attr('id'),'_blank');
//		$.ajax({
//			  url: "create/"+data.rslt.parent.attr('id'),
//			  cache: false,
//			  success: function(html){
//			    $("#PageModification").html(html);
//			    $("#PageModification").dialog("open");
//			    $('.editor').redactor();
//			    $('#Page_type_id').change();
//			  }
//			});
		/*$.post(
	        "'.$this->ajaxUrl.'", 
	        { 
	            "simpletree" : 1,
	            "operation" : "create_node", 
	            "id" : data.rslt.parent.attr("id").replace("node_",""), 
	            "position" : data.rslt.position,
	            "title" : data.rslt.name,
	            "type" : data.rslt.obj.attr("rel"),
	        }, 
	        function (r) {
	            if(r.status) {
	                $(data.rslt.obj).attr("id", "node_" + r.id);
	                '.$this->onCreate.'
	            }
	            else {
	                $.jstree.rollback(data.rlbk);
	            }
	        }
	    );*/
	})
	.bind("remove.jstree", function (e, data) {
		if (confirm("Вы уверены, что хотите удалить "+data.rslt.obj.length+" элемент(ов)")) {
		data.rslt.obj.each(function () {
	        if (data.inst._get_type(this) == "readonly")
	            return;
	        $.ajax({
				  url: "delete/" + $(this).attr("id"),
				  cache: false,
				  type: "POST",
				  success: function(html){
					  if(html != "")
						  alert(html);
					  else
						  alert('Ok');
				  }
			});
	    });
		}
		else
			$.jstree.rollback(data.rlbk);
	})
	.bind("move_node.jstree", function (e, data) {
		console.log(data);
		var action = data.rslt.cy ? 'скопировать' : 'перенести';
		if (confirm("Вы уверены, что хотите "+action+' '+data.rslt.o.length+" объект(ов) в папку \"" + $(data.rslt.np).children('a').text() + "\"")) {
			data.rslt.o.each(function (i) {
				console.log(data.rslt);
		        $.ajax({
		            async : false,
		            //type: 'POST',
		            url: ajaxUrl+"ajaxTree/move",
		            dataType: 'json',
		            data : { 
		            	"id" : $(this).attr("id"), 
		            	"to" : data.rslt.np.attr("id"),
		            	"position" : data.rslt.cp ,
		                "copy" : data.rslt.cy ? 1 : 0,
		            },
		            success : function (result) {
		                if(result.status!=200) {
		                	alert(result.error);
		                	console.log(data.rlbk);
		                    $.jstree.rollback(data.rlbk);
		                }
		                else {
		                    //$(data.rslt.oc).attr("id", r.id);
		                    //if(data.rslt.cy) {
		                       data.inst.refresh($(this).attr("id"));
		                   // }
		                   // '.$this->onMove.'
		                }
		            },
		            error : function (result) {
		            	alert('Ошибка на сервере');
		            	data.inst.refresh($(this).attr("id"));
		            }
		        });
		    });
		}
		else
			$.jstree.rollback(data.rlbk);
	})
	.bind("load_node.jstree", function (e, data) {
		current = data.rslt.obj != '-1' ? $(data.rslt.obj) : $('#1');
    	$(current).children("ul").children("li").each( function () {
    		detail = $("<span class='detail'></span>");
    		if ($(this).attr('page'))
    		{
    			pager = renderTreePager( this);
    			detail.append(pager);
    		}
    		if ($(this).attr('count'))
    			detail.append("<span class='count'>["+$(this).attr('count')+"]</span>");
    		$(this).prepend(detail);
		});
		
	})
	.delegate("a","click", function (e){
		clicks++;
	    var current = $(this).parent();
	    if (clicks == 1) {
	    	setTimeout(function(){
	    		if(clicks == 1) {
	   				if ( $(current).attr("class") ==  "jstree-closed")
						$("#pageTree").jstree("open_node", current);
					else
						$("#pageTree").jstree("close_node", current);
				} 
				else {
					editTreeObject(current);
	          }
	          clicks = 0;
	        }, 200);
	 }
	})
	.delegate(".treepager span:","click", function (e){
	    var current = $(this).parent().parent().parent();
	    $(current).attr('page',$(this).html() );
	    pager = renderTreePager(current);
	    $(this).parent().replaceWith(pager);

	    if (!$("#pageTree").jstree("is_open", $(current)))
	    	$("#pageTree").jstree("open_node", $(current));
	    else
	    {
	    	 if ($(this).attr('class')=='current')
	 	    	return;
	    	 $("#pageTree").jstree("refresh", $(current));
	    }
	    	

	});
});