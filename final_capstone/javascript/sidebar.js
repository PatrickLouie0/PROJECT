
         $('.btn').click(function(){
           $(this).toggleClass("click");
           $('.sidebar').toggleClass("show");
         });
           $('.feat-btn').click(function(){
             $('nav ul .feat-show').toggleClass("show");
             $('nav ul .first').toggleClass("rotate");
           });
           $('.serv-btn').click(function(){
             $('nav ul .serv-show').toggleClass("show1");
             $('nav ul .second').toggleClass("rotate");
           });
           $('.view-btn').click(function(){
             $('nav ul .view-show').toggleClass("show3");
             $('nav ul .forth').toggleClass("rotate");
           });
            $('.sale-btn').click(function(){
             $('nav ul .sale-show').toggleClass("show2");
             $('nav ul .third').toggleClass("rotate");
           });
                        //member
            $('.feat-btn-member').click(function(){
             $('nav ul .feat-show-member').toggleClass("show3");
             $('nav ul .fourth').toggleClass("rotate");
           });
          
           $('nav ul li').click(function(){
             $(this).addClass("active").siblings().removeClass("active");
           });
      