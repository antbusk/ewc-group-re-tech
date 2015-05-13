








<?php if ($_GET['f3'] == '2') { ?>
<select class="form-control input-sm" name="products_f3">
  <option value="1-1">Sativa</option>
  <option value="1-2">Indica</option>
  <option value="1-3">Hybird</option>
</select> 
<?php
} else {
?>	
<input class="form-control input-sm"  name="products_f3" type="text" value="0" disabled/>
<?php 
}
?>