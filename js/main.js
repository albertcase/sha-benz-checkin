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
                    if(data.code==1){
                        $(".one").fadeIn();
                    }
                    if(data.code==3){
                        $(".two").fadeIn();
                    }
                    if(data.code==4){
                        $(".three").fadeIn();
                    }
                    /*alert(data.msg);*/
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
        $(".one .hideTips").on("click",function(){
            
            $(".one").fadeOut();
            $("#file").val("");
            
        });
        $(".two .hideTips").on("click",function(){
            
            $(".two").fadeOut();
            $("#file").val("");
            
        });
        $(".three .hideTips").on("click",function(){
            
            $(".three").fadeOut();
            $("#file").val("");
            
        });
  
    })
})(jQuery)