<?php foreach($roomList as $roomNumber):?>
<input type="submit" name="roomNumber" class = "roomButton"id="<?php echo $roomNumber->number;?>" value="<?php echo $roomNumber->number;?>">
<br>
<br>
<br>
<?php endforeach;?>
<br>

</form>