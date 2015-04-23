;(function($){
    $(function(){
     
   		$(".submit_btn").on("click", function(){
            var file=$("#file").val();
            if(file==""||file=="请输入您的姓名"){
            	
            	return false;
            }
        });

        $(".view_btn").on("click",function(){
        	window.location.href="view.php";
        })  
  
    })
})(jQuery)