/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var imageId;
var userId;
var vote;

$("#btn-thumbdown").click(function(){
    alert("Your book is overdue.");
    $.post("vote.php",
  {
    imageId:"1",
    userId: "1",
    vote:"down"
  },
  function(data,status){
    alert("Data: " + data + "\nStatus: " + status);
  });
});
