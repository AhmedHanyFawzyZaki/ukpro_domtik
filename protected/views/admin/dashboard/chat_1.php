<?php
$this->pageTitle = Yii::app()->name . ' - Chat';
?>
 <div class="content2">

        <?php if ($users): ?>
                            <div class="list_users" style="">

                                <ul>
                                    <?php foreach ($users as $user): ?>

                                        <?php if ($user['chat_id'] == $_REQUEST['chat']): ?>
                                            <li <?php
                                            if ($user['chat_id'] == $_REQUEST['chat']) {
                                                echo 'class="active"';
                                            }
                                            ?> >
                                                    <?php
                                                    if ($user['user']->alive > strtotime("-5 minutes")) {
                                                        echo "<img src='" . Yii::app()->baseUrl . "/img/rate.png'/>";
                                                    } else {
                                                        echo "<img src='" . Yii::app()->baseUrl . "/img/rate2.png'/>";
                                                    }
                                                    ?>
                                                <img width="50" height="50" src="<?= Yii::app()->baseUrl ?>/media/members/<?= $user['user']->image ? $user['user']->image : "register-icon.png" ?>" /> <?= $user['user']->username ?></li>
                <?php else: ?>
                                            <li>
                                                <a href="<?= Yii::app()->baseUrl ?>/home/chat/<?= $location->id ?>?chat=<?= $user['chat_id'] ?>" >
                                                    <?php
                                                    if ($user['user']->alive > strtotime("-5 minutes")) {
                                                        echo "<img src='" . Yii::app()->baseUrl . "/img/rate.png'/>";
                                                    } else {
                                                        echo "<img src='" . Yii::app()->baseUrl . "/img/rate2.png'/>";
                                                    }
                                                    ?>
                                                    <img width="50" height="50" src="<?= Yii::app()->baseUrl ?>/media/members/<?= $user['user']->image ? $user['user']->image : "register-icon.png" ?>" /> 
                                                    <?= $user['user']->fname . ' ' . $user['user']->lname ?>
                    <?= $user['user']->fname . ' ' . $user['user']->lname ?>
                                                </a>
                                            </li>
                                        <?php endif; ?>
            <?php endforeach; ?>
                                </ul>

                            </div>
                        <?php endif; ?>
                        <div class="chat_container" <?php
                        if (!$users) {
                            echo "style='width: 96%'";
                        }
                        ?> >
<!--                            <div id='chat'>

                            </div>-->

                          
                                  <?php
                            $criteria=new CDbCriteria;
$criteria->select="chat_id"; //declare year1 in model
$criteria->distinct=true;
                        $chats = YiichatPost::model()->findAll($criteria);   
//                        echo '<pre>'; 
//                        print_r($chats);
//                         echo '<pre>'; 
                        foreach ($chats as $chat){
                            $owner = YiichatPost::model()->find("chat_id = $chat->chat_id and chat_id !=1")->owner;
                            echo '<br><br><br><br>'
                            . '<h3>'.$owner.'yyyy</h3>'
                                    . '<div id="chat-'.$chat->chat_id.'">

                            </div>';
                            //  if ($_REQUEST['chat']){ 
                            $this->widget('YiiChatWidget', array(
                                'chat_id' => $chat->chat_id, // a chat identificator
                                'identity' => Yii::app()->user->id, // the user, Yii::app()->user->id ?
                                'selector' => '#chat-'.$chat->chat_id.'', // were it will be inserted
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
                        }
//                              }else{
//                        echo"<h2>There is no messages for you</h2>";
//                              }
                            
                            ?>   
                               
                            
                      
                               
                            
                       
                           
                        </div>
                    </div>
<!--<script>

$(function(){ 
   $(document).ajaxStart(function() {
console.log( "Triggered ajaxStart handler." );
$.ajax({
        url: '<?php echo Yii::app()->createUrl('users/newwindow'); ?>',
        type:'post',
       // data: "id="+file_id,
       
        success: function (data) {
            //alert(data);
   
            console.log(data);
        //  $(".modal-content").html(data);  	
					
                    
        }
}); 
}); 
});
</script>-->