tinymce.init({
  selector: "textarea",
  height: 400,
  plugins: [
    "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
    "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
    "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
  ],

  toolbar1: "bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
  toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
  toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft",

  menubar: false,
  toolbar_items_size: 'small',

  
});

$(document).ready(function(){
    $('#select-all').click(function(event){
        if(this.checked){
            $('.checkboxes').each(function(){
                this.checked = true;
            })
        }else{
            $('.checkboxes').each(function(){
                this.checked = false;
            })
        }
    });


    /*var div_box = "<div id='load-screen'><div id='loading'></div></div>";

    $("body").prepend(div_box);

    $("#load-screen").delay(700).fadeOut(600, function(){
        $this.remove();
    })*/

});

function refreshOnlineUsers(){
    $.get("functions.php?onlineUsers=result", function(data){
        $(".usersOnline").text(data);
    });
}

function refreshCommentCount(){
    $.get("functions.php?updateComment=result", function(data){
        $(".commentCount").text(data);
    });
}

setInterval(function(){
    refreshOnlineUsers();
    refreshCommentCount();
}, 500);




