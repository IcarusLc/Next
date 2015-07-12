<!DOCTYPE html>
<html>
<head>
    <title>upload</title>
</head>
<body>
    <form method="post" action="<?php echo base_url('upload/pic');?>" enctype="multipart/form-data">
        <input type="file" name="pic"><br>
        <input type="submit" value="提交">
    </form>
</body>
</html>