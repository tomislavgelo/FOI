function sakrijPokazi(el) 
{ 
  var childs =  el.childNodes;

  for(i = 1; i < childs.length; i++)
  {
    if(childs[i].style.visibility === "visible")
    {
      childs[i].style.visibility = "hidden";
    }
    else
    {
      childs[i].style.visibility = "visible";
    }
  }
}