<?php
class DbVeza
{
  private static $veza = null;

  public static function dobijVezu()
  {
    if(self::$veza == null)
    {
      try
      {
        self::$veza = new PDO(
          'mysql:host=localhost;dbname=iwa_2016_zb_projekt',
          'iwa_2016',
          'foi2016',
          array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"')
        );
      }
      catch(PDOException $e)
      {
        header('Location: ../view/greska.php?greska=db');
        
        die();
      }
    }
    return self::$veza;
  }
}