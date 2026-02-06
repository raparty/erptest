<?php
declare(strict_types=1); 
require_once("config/config.inc.php");
ob_start();
$sid = (int)($_GET['sid'] ?? 0);
if ($sid > 0)
{
		//$issue_date=$_POST['issue_date'];
		
		  $sql3="UPDATE student_books_detail set booking_status='0'   where issue_id='".$sid."'";
		$res3=db_query($sql3) or die("Error : " . db_error());
		header("Location:library_student_return_books.php");
		
		
		
		$select_fine_days="select * from library_fine_manager where session='".$_SESSION['session']."'";
$res_select=db_query($select_fine_days);
$row_fine=db_fetch_array($res_select);

$row_fine_days=$row_fine['no_of_days']-1;
$row_fine_rate=$row_fine['fine_rate'];


	 $sql="SELECT * FROM student_books_detail where issue_id='".$sid."'";
					$res=db_query($sql);
					  
							
				$row=db_fetch_array($res);
				
				
				 $return_date=date('Y-m-d',strtotime($row['issue_date']."+".$row_fine_days."days"));

$now = time(); // or your date as well
     $your_date = strtotime($return_date);
     $datediff = $now - $your_date;
     $number_of_days=floor($datediff/(60*60*24));
	 
				
				if($number_of_days>0)
				{
					$total_fine=$number_of_days*$row_fine_rate;
					
					
					$insert_fine_detail_q="insert into student_fine_detail(registration_no,book_number,no_of_days,fine_amount,session)values('".$row['registration_no']."','".$row['book_number']."','".$number_of_days."','".$total_fine."','".$_SESSION['session']."')";
					db_query($insert_fine_detail_q);
					}
							
	 
	 
	 
		
	}
	?>