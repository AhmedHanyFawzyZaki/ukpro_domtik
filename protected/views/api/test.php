
<form method="post" action="<?php echo Yii::app()->request->baseUrl; ?>/api/<?= $_GET['action'] ?>">

    <textarea cols="100" rows="30" name="data" class="test" style="margin-left: 20%;
    margin-top: 4%;"></textarea>
<input type="submit" value="Go" />
     </form>


