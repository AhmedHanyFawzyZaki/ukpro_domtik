 
     

        
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js"></script>
<script src="/2014/domtik/assets/43df1ccf/yiichat.js"></script>
<link type="text/css" rel="stylesheet" href="a/2014/domtik/assets/43df1ccf/yiichat.css">

<style  ></style>
<div class="content2">
     <ul>
     <?php 
     
     foreach ($users as $user){
         $owner = Yii::app()->user->fname.' '.Yii::app()->user->lname;
         $unseen_messages = count(YiichatPost::model()->findAll("chat_id = $user->id and owner != '$owner' and seen = 0"))
         ?>
         <li> 
             <a class="userr" id="<?php echo $user->id ?>" href="<?php echo Yii::app()->getBaseUrl(true)."/admin/dashboard/loadIframe/chat_id/$user->id"; ?>"><?php echo $user->username; ?>
             (<span class="seen-count" id="<?php echo $user->id ?>" val="<?php echo $unseen_messages ?>"><?php echo $unseen_messages ?></span>)</a></li>
     
 <?php
         
     }
     
     ?>
         </ul>
   
                           
<div class="chat_container" >
    <?php 
     $chat_id = $_GET['chat_id'];
     if(isset($chat_id) and $chat_id != null){
    $owner = User::model()->find("id = $chat_id")->username;
     }
     ?>
    <h3><?php echo $owner; ?></h3>
                            <div id='chat'>

                            </div>

                          
                                  <?php
                                  $user_id = Yii::app()->user->id;
                           $some_user = User::model()->find("id != $user_id")->id;
                          
                            $this->widget('YiiChatWidget', array(
                                'chat_id' => $some_user, // a chat identificator
                                'identity' => Yii::app()->user->id, // the user, Yii::app()->user->id ?
                                'selector' => '#chat', // were it will be inserted
                                'minPostLen' => 2, // min and
                                'maxPostLen' => 255, // max string size for post
                                'defaultController' => 'admin/dashboard',
                                //"timerMs"=>5000,
                                'model' => new ChatHandler(), // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
                                'onSuccess' => new CJavaScriptExpression(
                                "function(code, text, post_id){   }"),
                                'onError' => new CJavaScriptExpression(
                                "function(errorcode, info){ }"),
                                
                            ));
                            
                   //     }
//                              }else{
//                        echo"<h2>There is no messages for you</h2>";
//                              }
                            
                            ?>   
                               
                            
                      
                               
                            
                       
                           
                        </div>
                    </div>
        
       <script>
          //  $(function(){ 
            //    alert('fdere');
                setInterval(function(){
            $(".seen-count").each(function(){
              var chat_id = $(this).attr('id');
          var $this= $(this);
                     $.ajax({
        url: '<?php echo Yii::app()->createUrl('admin/dashboard/getSeenCount'); ?>',
        type:'post',
        data: "chat_id="+chat_id,
       
        success: function (data) {
            //alert(data);
   
            console.log(data);
          $this.html(data);  	
					
                    
        }
}); 
 });

                }, 10000);
              
          //  });
        </script>
        
        <?php
        
        
//    public function ActionLoadIframe(){
//        if($_GET['chat_id']){
//            $chat_id = $_GET['chat_id'];
//    $user_chats =  YiichatPost::model()->findAll("chat_id = $chat_id");
//   // print_r($user_chats);die;
//    foreach ($user_chats as $chat){
//        $user_chat =  YiichatPost::model()->find("id = '$chat->id'");
//        $user_chat->seen=1;
//        $user_chat->save(false);
//    }
//        }
//        
//        
//        $users = User::model()->findAll();
//          $this->render('chat_iframe', array('users' => $users));
//    }
//    
//    public function ActionGetSeenCount(){
//  $chat_id = $_POST['chat_id'];
//   $owner = Yii::app()->user->fname.' '.Yii::app()->user->lname;
//         $unseen_messages = count(YiichatPost::model()->findAll("chat_id = $chat_id and owner != '$owner' and seen = 0"));
//   echo $unseen_messages;
//    }
        ?>