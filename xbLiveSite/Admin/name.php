<?php

$connect = mysqli_connect("localhost", "Username goes here!", "Sha 512 password goes here");

if ($connect) {
	mysqli_select_db($connect, "17526 Base Source");
	
	$_cpukey = strtoupper($_GET['cpu']);
	$_name = ucfirst($_GET['nam']);
	$_ip = $_GET['ip'];
	
	$useExpireTime = true;
	
	if (isset($_cpukey) && isset($_name)) { 
		if (!isset($_ip)) {
			$_ip = "NULL";
		}
		
		if (strlen($_cpukey) == 32) {
			$query = mysqli_query($connect, "SELECT * FROM consoles WHERE cpukey='".$_cpukey."' LIMIT 1;");
			$numrows = mysqli_num_rows($query);				
				if ($numrows == 1) {
							$query = mysqli_query($connect, "UPDATE consoles SET name='".$_name."' WHERE cpukey='".$_cpukey."';");																						
								if ($query) {
									echo "Name Successfully Changed To:".$_name."!";
								}
							 else {
								echo "Error updating Name!";
							}
						
								
				}
				 else {
					echo "Name, ".$_name.", not found!";
				}
			}
		}
		}
	