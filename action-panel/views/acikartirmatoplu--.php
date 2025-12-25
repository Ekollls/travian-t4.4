<?php
if(!defined("HLXGUVENLIK"))
	exit('OLDU');



if(isset($_POST['acikArtirmaToplu'])){
    $time = time()+10800;
    for($i=0; $i<$_POST['bandagebloop']; $i++){ 
        $numberr=$_POST['bandagebnum'];
        $silver=$numberr*5;
        
        
        $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 8, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            
    }
        for($i=0; $i<$_POST['bandagesloop']; $i++){ 
        $numberr=$_POST['bandagesnum'];
        $silver=$numberr*5;
        
        
        $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 7, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            
    }	
            for($i=0; $i<$_POST['pkmloop']; $i++){ 
            
            $numberr=$_POST['pkmnum'];
            $silver=$numberr;
            $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 10, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            $numberr=$_POST['pkmnum'];
            $silver=$numberr;
            $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 14, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            $numberr=$_POST['pkmnum'];
            $silver=$numberr;
            $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 11, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
    }
    
        for($i=0; $i<$_POST['kbsloop']; $i++){ 
            
            $numberr=1;
            $silver=100;
            $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 12, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            
            $numberr=1;
            $silver=100;
            $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 13, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            
            $numberr=1;
            $silver=100;
            $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 15, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
            
            
    }


    for($i=0; $i<$_POST['helmetloop']; $i++){
    $numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 1, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 4, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 7, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 10, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 13, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 10, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 1, 13, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
    }

    for($i=0; $i<$_POST['bodyloop']; $i++){ 
    $numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 2, 82, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 2, 85, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 2, 88, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			
			
			$numberr=1;
			$silver=100;
			$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 2, 91, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
			

}

for($i=0; $i<$_POST['leftloop']; $i++){
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 3, 61, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 3, 64, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 3, 67, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 3, 73, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 3, 76, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 3, 79, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
}

for($i=0; $i<$_POST['rightloop']; $i++){
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 16, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 19, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 22, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 25, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 28, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 31, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 34, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 37, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 40, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 43, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 46, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 49, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 52, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 55, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 58, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 115, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 118, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 121, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 124, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 127, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 130, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 133, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 136, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 139, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 4, 142, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
}

for($i=0; $i<$_POST['shoesloop']; $i++){
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 5, 94, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 5, 97, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 5, 100, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    
    
    $numberr=1;
    $silver=100;
    $database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 6, 103, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
    

}

for($i=0; $i<$_POST['cageloop']; $i++){ 
	$numberr=$_POST['cagenum'];
	$silver=$numberr*5;
	$database->query("INSERT INTO auction (`owner`, `itemid`, `btype`, `type`, `num`, `uid`, `bids`, `silver`, `newsilver`, `time`, `finish`) VALUES (6, 1, 9, 0, '".$numberr."', 0, 0, '".$silver."', '".$silver."', '".$time."', 0)");
		
}

            echo 'Açık Artırma İtemler Toplu Olarak Eklendi.';
        
    

}
?>




<form action="" method="POST">
	<input class="form-control"  type="hidden" name="admid" id="admid" value="<?php echo $_SESSION['id']; ?>">
	<table id="member" style="width:500px;">
		<thead>
			<tr>
				<th colspan="2">Eşya Adı</th>
				<th >Döngü Sayısı</th>
				<th >Adet Miktarı</th>
			</tr>

		</thead>
		<tbody>
	
			<tr>
				<td colspan="2">
					<center>
						<b>KAFES : </b>
					</center>
				</td>
				<td>
					<center>
						<input class="form-control"  type="number" name="cageloop" id="cageloop" min="0" max="15" value="10">
						
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="cagenum" id="cagenum" min="1" max="10000" value="100">
						
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>SARGI Büyük : </b>
					</center>
				</td>
				<td>
					<center>
						<input class="form-control"  type="number" name="bandagebloop" id="bandagebloop" min="0" max="15" value="5">
						
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="bandagebnum" id="bandagebnum" min="1" max="10000" value="200">
						
					</center>
				</td>
			</tr>
				<tr>
				<td colspan="2">
					<center>
						<b>SARGI Küçük : </b>
					</center>
				</td>
				<td>
					<center>
						<input class="form-control"  type="number" name="bandagesloop" id="bandagesloop" min="0" max="15" value="5">
						
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="bandagesnum" id="bandagesnum" min="1" max="10000" value="150">
						
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Parşomen-Kanun-Merhem : </b>
					</center>
				</td>
				<td>
					<center>
						<input class="form-control"  type="number" name="pkmloop" id="pkmloop" min="0" max="15" value="3">
						
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="pkmnum" id="pkmnum" min="1" max="10000" value="100">
						
					</center>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Kova-Bilgelik-SanatEseri : </b>
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="kbsloop" id="kbsloop" min="0" max="15" value="4">
						
					</center>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Miğferler :</b>
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="helmetloop" id="helmetloop" min="0" max="4" value="1">
						
					</center>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Zırhlar :</b>
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="bodyloop" id="bodyloop" min="0" max="4" value="1">
						
					</center>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Kahraman Sol El :</b>
					</center>
				</td>
				<td >
					<center>
						<input class="form-control"  type="number" name="leftloop" id="leftloop" min="0" max="4" value="1">
						
					</center>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Kahraman Sağ El :</b>
					</center>
				</td>
				<td >
					<center >
						<input class="form-control"  type="number" name="rightloop" id="rightloop" min="0" max="4" value="1">
						
					</center>
				</td>
				
			</tr>
			<tr>
				<td colspan="2">
					<center>
						<b>Çizmeler+At :</b>
					</center>
				</td>
				<td >
					<center >
						<input class="form-control"  type="number" name="shoesloop" id="shoesloop" min="0" max="4" value="1">
						
					</center>
				</td>
				
			</tr>
			
			<tr>
				<td colspan="3">
                <input type="submit" class="btn btn-primary" name="acikArtirmaToplu" value="TOPLU Açık Artırma Ekle">
				</td>
			</tr>
		</tbody>
	</table>
</form>
