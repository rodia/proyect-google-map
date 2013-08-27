<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
  <div style="text-align:center;">
    <p><a href="<?php echo $_SERVER['REQUEST_URI'].'import.php?t='.'victim'; ?>">victim</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo $_SERVER['REQUEST_URI'].'import.php?t='.'party'; ?>">party</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a href="<?php echo $_SERVER['REQUEST_URI'].'import.php?t='.'collision'; ?>">collins</a>
    <a href="<?php echo $_SERVER['REQUEST_URI'].'import.php?t='.'collision_point&separator=,'; ?>">collins Point</a>
    <a href="<?php echo $_SERVER['REQUEST_URI'].'import.php?t='.'detail_point&separator=,'; ?>">Detail Point</a></p>
  </div>
</body>
</html>