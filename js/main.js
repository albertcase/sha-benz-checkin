;(function($){
    $(function(){
     
   		$(".submit_btn").on("click", function(){
           
            var file=$("#file").val();
            if(file==""||file=="请输入您的姓名"){
                $("#file").val("").addClass("error");
               	return false;   	
            }

            $.ajax({
                "url":"./Request.php",
                "type":"post",
                "data":{"model":"search","cardnum":file},
                "dataType":"json",
                "success":function(data){
                    alert(data.msg);
                }
            });
        });
         $("#file").focus(function(){
            if($(this).attr('placeholder')=="请输入您的姓名"){
                $(this).val("");
                $(this).removeClass("error");
            }
        });
        /*$(".view_btn").on("click",function(){
        	window.location.href="view.php";
        });*/
        $(".search_btn").on("click",function(){
        	
            window.location.href="view.php?cardnum="+$("#content").val();
            
        });
  
    })
})(jQuery)