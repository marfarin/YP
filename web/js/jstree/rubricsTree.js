$(document).ready(function()
{
	var clicks = 0;
	var pagerLimit = 2; //колличество страниц в пагинаторе
	var pageSize = 100; // колличество элементов до вывода пагинации
	
	var ajaxUrl = $('#rubricTree').attr('url');
	
	function editTreeObject(obj)
	{
            window.location.href = "update?id="+obj.attr('id');
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
	
	$("#rubricTree").jstree({
	    "plugins" : [ "themes", "json_data", "ui", "crrm", "cookies", "search"],
	    "core" : {
	        "animation" : 300
	    },
	    "json_data" : {
	        "ajax" : {
	            // the URL to fetch the data
	            "url" : ajaxUrl+"category/test",
	            "data" : function (n) { 
	                return { 
	                    "parentId" : n.attr ? n.attr("id") : null,
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
	    "search" : {
            "case_insensitive" : true,
            "show_only_matches" : true,
            "ajax" : {
                    "url" : ajaxUrl+"rubric/ajaxSearch",
                    "data" : function () {
                            return { p_search : this.data.search.str };
                    }
            },
            "success" : function(data){
            	console.log(data);
            }

        },
	    "themes" : {
	        "theme" : "apple",
	    },
	    "dnd" : {
	    	"open_timeout" : 2000,
	    },
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
						$("#rubricTree").jstree("open_node", current);
					else
						$("#rubricTree").jstree("close_node", current);
				} 
				else {
					editTreeObject(current);
	          }
	          clicks = 0;
	        }, 200);
	 }
	});
	
	var to = false;
	
    $('#treeSearch').keyup(function () {
            if(to) { clearTimeout(to); }
        to = setTimeout(function () {
            var v = $('#treeSearch').val();
            $.jstree._reference(current.attr('id')).search(v);
        }, 250);
    });
    
});