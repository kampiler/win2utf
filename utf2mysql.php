<?require_once(getenv('DOCUMENT_ROOT').'/_lib/config.php');?>
<?$title='utf4mysql';?>

<?require_once('_header.php');?>

<?
  $db4fix='Complex1';
  echo "ALTER DATABASE `$db4fix` charset=utf8;";
  $t=evd_table_list($db4fix);
  foreach($t as $table_id=>$table)
    {
     $sql="ALTER TABLE `$db4fix`.`$table` CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;";
     echo "<li>$sql";
    }
?>

<?require_once('_footer.php');?>