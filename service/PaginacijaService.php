<?php
class PaginacijaService
{
  public function paginacija($stranica, $brojStranica, $trenutnaStranica)
  {
    if($trenutnaStranica != 1)
    {
      $prethodnaStranica = $trenutnaStranica - 1;
      $lokacija = $stranica.'?stranica='.$prethodnaStranica;
      echo '<a href='.$lokacija.'> &lt; </a>';
    }
    for($i = 1; $i <= $brojStranica; $i++)
    {
      if(strpos($stranica, '?'))
      {
        $lokacija = $stranica.'&stranica='.$i;
        echo '<a href='.$lokacija.'> '.$i.' </a>';
      }
      else
      {        
        $lokacija = $stranica.'?stranica='.$i;
        echo '<a href='.$lokacija.'> '.$i.' </a>';
      }
    }
    if($trenutnaStranica < $brojStranica)
    {
      if(strpos($stranica, '?'))
      {
        $sljedecaStranica = $trenutnaStranica + 1;
        $lokacija = $stranica.'&stranica='.$sljedecaStranica;
        echo '<a href='.$lokacija.'> &gt; </a>';
      }
      else
      {
        $sljedecaStranica = $trenutnaStranica + 1;
        $lokacija = $stranica.'?stranica='.$sljedecaStranica;
        echo '<a href='.$lokacija.'> &gt; </a>';
      }
    }
  }
}