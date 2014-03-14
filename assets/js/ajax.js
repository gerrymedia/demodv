/* 
 * Jquery Ajax would is my targeted solution for the voting (the thumbs up and thumbs down) as it is more secure and elegant 
 * instead of passing the votes by HTTP $_GET
 * 
 * The pseudo-code:
 * 
 * onClick of #btn-*
 *  $.post(to our PHP controller)
 *      data
 *  
 * on success
 *      alert user with modal
 *          "Thank you for voting
 *      update the voting percentages
 * 
 * 
 */
/*
var imageId;
var userId;
var vote;

$("#btn-thumbdown").click(function(){
    
    $.post("vote.php",
  {
    imageId:"1",
    userId: "1",
    vote:"down"
  },
  function(data,status){
    alert("Data: " + data + "\nStatus: " + status);
  });
}); */
