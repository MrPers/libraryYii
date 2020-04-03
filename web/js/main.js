$( document ).ready(function() { 
  $(".star").on("mouseover", function(){
      $(".star").slice(0, $(".star").index(this)+1).addClass("star2");
  });
  $(".star").on("mouseout", function(){
      $(".star").slice(0, $(".star").index(this)+1).removeClass("star2");
  });
  $(".star").on("click", function(){
      jQuery.post("/book/insert/", {            ``
          obj_id: $(this).parent().attr("id"),
          stars: $(".star").index(this)+1
      });
      location.reload();
  });
});
  