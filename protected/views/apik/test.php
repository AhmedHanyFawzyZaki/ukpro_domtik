
<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/apik/<?= $_GET['action'] ?>">

<textarea cols="30" rows="10" name="data" class="test"></textarea>
<input type="submit" value="Go" />
     </form>
