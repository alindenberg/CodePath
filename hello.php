<html>
 <head>
  <title>CodePath Prework</title>
 </head>
 <body style="background-color: yellow">
 	<div id = "calculator">
	 	<h1> TIP CALCULATOR </h1>
	 	<form method = "POST">
	 		<h3>Bill Subtotal <span>$</span><input type="text" placeholder="0.00"name="bill" value="<?php echo $_POST['bill'];?>"></h3>
	  		<h3>Tip percentage</h3>
	 		<?php 
	 			// Variables for the bill, tip percentage, the custom tip from the user, and the no. of people splitting the bill.
	 			$bill = $_POST['bill'];
	 			$tipPercent = $_POST['selectedTip'];
	 			$customTip = $_POST['customTip'];
	 			$splitCount = $_POST['splitCount'];
	 			// Loop to create radio buttons
	 			for($count = 10; $count < 21; $count+=5) {
	 				echo "<td> $count%"; 
	 				echo '<input type="radio" name="selectedTip" value="'.$count.'"'; 
	 				if(isset($_POST['selectedTip']) && $count == $tipPercent && $customTip == NULL) {
	 					echo ' checked="checked" '; 
	 				} 
	 				echo '/></td>';
	 			}
	 			// Create custom tip text field
	 			echo '<br><br><span>Custom Tip: %</span><input type="text" placeholder="0" name="customTip" value="'.$customTip.'"/><br>';
	 			// Create text field to input number of people splitting the bill
	 			echo '<span>Split total amongst: </span><input type="text" placeholder="1" name="splitCount" value="'.$splitCount.'"/><span>people.</span><br>';

	 		?>
	 		<br>
	 		<br>
	 		<input type = "submit" value="Get Tip">
		</form>
		<?php
			function getTip($bill, $tipPercent, $splitCount) {
				$tip = $bill * ($tipPercent/100);
				$tip = number_format($tip, 2);
				$total = number_format($bill + $tip, 2);
				if($splitCount == NULL) {
					echo "Calculated tip: $$tip <br>";
					echo "Total is: $$total <br>";
				}
				else if(($splitCount > 0 && is_numeric($splitCount))) {
					$splitBill = number_format($total / $splitCount, 2);
					echo "Calculated tip: $$tip <br>";
					echo "Total is: $$total <br>";
					echo "Each person pays: $$splitBill";
				}else {
					echo "<span>Error: <strong><u># of people splitting the bill</u></strong> must be a valid number greater than 0</span>";
				}
				// If the bill is being covered by more than 1 person, outprint another line for the amount each person will pay
			}
			if($bill != NULL) {
				// Check that the bill entered is a number greater than 0
				if($bill > 0 && is_numeric($bill)) {
					// Give priority to the custom tip the user entered in the scenario they select a tip value as well as enter one before calculating.
					if($customTip != NULL) {
						// Check that the tip is a number greater than 0
						if($customTip > 0 && is_numeric($customTip)) {
							getTip($bill, $customTip, $splitCount);
						} else {
							echo "<span>Error: <strong><u>Custom Tip</u></strong> percentage must be a valid number greater than 0</span>";
						} 
					}
					else if($tipPercent != NULL) {
						getTip($bill, $tipPercent, $splitCount);
					}
					else {
						echo "<span>You must enter or select a percentage you would like to tip</span>";
					}
				}
				else {
					echo "<span>Error: <strong><u>Bill</u></strong> must be a valid number greater than 0</span>";
				}
			}
		?>
	</div>
 </body>
</html>