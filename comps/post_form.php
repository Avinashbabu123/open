<?
if($_SERVER['PHP_SELF']=="/search.php"){
 $q=filt($_GET['q']);
}
$sql=$db->prepare("SELECT server,access_token FROM oauth_session WHERE user=?");
$sql->execute(array($who));
while($r=$sql->fetch()){
 if($r['server']=='Twitter'){
  $tw=$r['access_token']=='' ? "":"checked";
  $twv=$r['access_token']=='' ? "":"true";
 }elseif($r['server']=='Facebook'){
  $fb=$r['access_token']=='' ? "":"checked";
  $fbv=$r['access_token']=='' ? "":"true";
 }
}
?>
<div class="post_form" id="post_form">
 <form action="ajax/post" method="POST" class="ajax_form" succ="Posted Successfully" err="Posting Failed. Try again." while="Posting">
  <div class="left">
   <img src="<?echo$uimg;?>" height="62" width="62"/>
  </div>
  <div class="right">
   <input type="text" id="show_form" style="width:100%;" placeholder="Have Something To Share ?">
   <div id="post_full_form" hide>
    <textarea placeholder="Share What's New :-)" class="textEditor" name="post"><?if($_SERVER['PHP_SELF']=="/search.php" && $q!=""){echo"$q : ";}?></textarea>
    <div style="float:left;position: relative;">
     <button type="button" id="prtoggle"></button>
     <select id="privacy" name="privacy" class="c_c" hide>
      <option value='pub'>Public</option>
      <option value='fri'>Friends</option>
      <option value='meo'>Only Me</option>
     </select>
     <button type="button" title="Post To Facebook" class="small" id="pfbit">
      <input type="hidden" id="fbverify" value="<?echo$fbv;?>"/>
      <input <?echo$fb;?> onclick="$(this)[0].click();" name="facebook" type="checkbox"/>
      <span>Facebook</span>
     </button>
     <button type="button" title="Post To Twitter" class="small" id="ptwit">
      <input type="hidden" id="twverify" value="<?echo$twv;?>"/>
      <input <?echo$tw;?> onclick="$(this)[0].click();" name="twitter" type="checkbox"/>
      <span>Twitter</span>
     </button>
    </div>
    <input type="submit" class="b-green" style="float:right;" name="submit" value="Post"/>
   </div>
  </div>
 </form>
</div>
<?
if($_SERVER['PHP_SELF']=="/search.php"){
 $d="<div style='background:#CCC;padding:10px 15px;border-radius:10px;'>";
 if($q!=""){
  echo "$d Showing posts that match \"<b>$q</b>\"</div>";
 }else{
  echo "$d Showing All Public Posts</div>";
 }
}
?>
