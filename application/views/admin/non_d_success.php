<?php
echo '<script type="text/javascript"> ';
echo ' function goback(newurl) {';
echo '  if (confirm("미결제 처리 되었습니다.")) {';
echo '    document.location = newurl;';
echo '  }';
echo '}';
echo 'goback(\'/admin\')';
echo '</script>';
