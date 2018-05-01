<?php
$this->pageTitle = Yii::app()->name . ' - Chat';
?>


<?php $user = User::model()->findByAttributes(array('id' => Yii::app()->user->id));
?>
<div class="row profile">

    <div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo Yii::app()->request->baseUrl; ?>/users/dashboard">Dashboard</a></li>

            <li class="active">Messages</li>
        </ol>

    </div>


    <div class="col-md-12 col-xs-12 profile-title">
        <p class="profile-name"><?php echo $user->username; ?></p>
    </div>

    <!--appear-->
    <?php $this->renderpartial('../home/menu', array('user' => $user)); ?>
    <!--end appear-->

    <div class="col-md-9 col-sm-8 col-xs-12 message-table">
        <h2 class="heading">Chat with Admin</h2>
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
//                                        if ($user['user']->alive > strtotime("-5 minutes")) {
//                                            echo "<img src='" . Yii::app()->baseUrl . "/img/rate.png'/>";
//                                        } else {
//                                            echo "<img src='" . Yii::app()->baseUrl . "/img/rate2.png'/>";
//                                        }
                                        ?>
                                    <img width="50" height="50" src="<?= Yii::app()->baseUrl ?>/media/members/<?= $user['user']->image ? $user['user']->image : "register-icon.png" ?>" /> <?= $user['user']->username ?></li>
                            <?php else: ?>
                                <li >
<!--                                    <a href="<?= Yii::app()->baseUrl ?>/home/chat/<?= $location->id ?>?chat=<?= $user['chat_id'] ?>" >-->
                                        <?php
//                                        if ($user['user']->alive > strtotime("-5 minutes")) {
//                                            echo "<img src='" . Yii::app()->baseUrl . "/img/rate.png'/>";
//                                        } else {
//                                            echo "<img src='" . Yii::app()->baseUrl . "/img/rate2.png'/>";
//                                        }
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
                <div id='chat'>


                </div>

                <?php
                //  if ($_REQUEST['chat']):
//                $chats = YiichatPost::model()->find
                $this->widget('YiiChatWidget', array(
                    'chat_id' => Yii::app()->user->id, // a chat identificator
                    'identity' => Yii::app()->user->id, // the user, Yii::app()->user->id ?
                    'selector' => '#chat', // were it will be inserted
                    'minPostLen' => 2, // min and
                    'maxPostLen' => 255, // max string size for post
                    'defaultController' => '/users',
                    'model' => new ChatHandler(), // the class handler. **** FOR DEMO, READ MORE LATER IN THIS DOC ****
                    'onSuccess' => new CJavaScriptExpression(
                            "function(code, text, post_id){   }"),
                    'onError' => new CJavaScriptExpression(
                      "function(errorcode, info){ }"),
                   
                ));
//                    else:
//                        echo"<h2>There is no messages for you</h2>";
//                    endif;
                ?>
            </div>
        </div>


    </div>
</div>

<!--appear-->
<?php $this->renderpartial('../home/sponsor'); ?>
<!--end appear-->
</div>
</div>


