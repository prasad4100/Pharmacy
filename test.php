








<?php


$getPid=mysqli_query($con,"SELECT id FROM patients WHERE name='{$pName}'");
	$pIdd=mysqli_fetch_array($getPid,MYSQLI_NUM);
	$pId=$pIdd[0];
	
	$getDetails=mysqli_query($con,"SELECT * FROM tempprescri WHERE customer_id='{$c_id}'");
			$file=fopen("recipts/docs/".$c_id.".txt","a+");
				while($itemm=mysqli_fetch_array($getDetails,MYSQLI_BOTH))
				{			
				$id=mysqli_query($con,"SELECT * FROM services WHERE name='{$itemm['service']}' ");
				$idd=mysqli_fetch_array($id,MYSQLI_BOTH);
				fwrite($file, $itemm['service'].";".$itemm['priority'].";".$itemm['cost']."\n");
											
					$count[] = $itemm['cost'];
				}
				$total=array_sum($count);
				fwrite($file, "TOTAL;;".$total."\n");
				 fclose($file);
	$enterInv=mysqli_query($con,"INSERT INTO invoices(invoiceNo, patient, amount, servedBy, status) VALUES('{$invoice}', '{$pId}', '{$total}', '{$who}', 'PENDING')");
	
	$enterDetails=mysqli_query($con,"SELECT * FROM tempinv WHERE inv='{$invoice}'");
			
				while($itemmm=mysqli_fetch_array($enterDetails,MYSQLI_BOTH))
				{			
				$servid=mysqli_query($con,"SELECT * FROM services WHERE name='{$itemmm['service']}' ");
				$idServ=mysqli_fetch_array($servid,MYSQLI_BOTH);
				$insDet=mysqli_query($con,"INSERT INTO invoicedetails(invoice, service) VALUES('{$invoice}', '{$idServ[0]}')");
							
				
				}
				$delet=mysqli_query($con,"DELETE FROM tempscri WHERE inv='{$invoice}'");	