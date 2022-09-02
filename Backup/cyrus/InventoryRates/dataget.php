<?php
include ('connection.php');
include ('session.php');
date_default_timezone_set('Asia/Calcutta');
$timestamp =date('y-m-d H:i:s');
$Date = date('Y-m-d',strtotime($timestamp));

$BankCode=!empty($_POST['BankCode'])?$_POST['BankCode']:'';
if (!empty($BankCode))
{
    $BankData="SELECT ZoneRegionCode,ZoneRegionName from zoneregions WHERE BankCode=$BankCode order by ZoneRegionName";
    $result = mysqli_query($con,$BankData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Zone</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['ZoneRegionCode']."'>".$arr['ZoneRegionName']."</option><br>";
        }
    }
    
}

$ZoneCodeE=!empty($_POST['ZoneCodeE'])?$_POST['ZoneCodeE']:'';
if (!empty($ZoneCodeE))
{
    $BankData="SELECT BranchCode,BranchName from branchs WHERE ZoneRegionCode=$ZoneCodeE order by BranchName";
    $result = mysqli_query($con,$BankData);
    if(mysqli_num_rows($result)>0)
    {
        echo "<option value=''>Select Branch</option>";
        while ($arr=mysqli_fetch_assoc($result))
        {
            echo "<option value='".$arr['BranchCode']."'>".$arr['BranchName']."</option><br>";
        }
    }
    
}

$ZoneCode=!empty($_POST['ZoneCode'])?$_POST['ZoneCode']:'';
if (!empty($ZoneCode))
{
    $ZoneData="SELECT * from cyrusbackend.item join cyrusbilling.rates on item.ItemID=rates.ItemID
    WHERE Zone=$ZoneCode order by ItemName";
    $result=mysqli_query($con,$ZoneData);
    if (mysqli_num_rows($result)>0)
    {   
        $Sr=1;
        while ($row=mysqli_fetch_assoc($result))
        {
            if ($row['Enable']==1) {
                $Status='Enabled';
            }else{
                $Status='Disabled';
            }
            print "<tr>";
            print '<td>'.$Sr."</td>";
            print '<td>'.$row['ItemName']."</td>";
            print '<td><a href="" class="ChangeDesc" id='.$row["Description"].' id2='.$row['RateID'].' data-bs-toggle="modal" data-bs-target="#ChangeDescription">'.$row['Description']."</a></td>";
            print '<td><a href="" class="ChangeRate" id='.$row['Rate'].' id2='.$row['RateID'].' data-bs-toggle="modal" data-bs-target="#ChangeRate">'.$row['Rate']."</a></td>";
            print '<td>'.date('d-M-y',strtotime($row['UpdateON']))."</td>"; 
            print "<td>".$Status."</td>";             
            ?>
            <td>
               <select class="form-control rounded-corner" id="Enb" id2="<?php echo $row['RateID']  ?>">
                <option value="">Select</option>
                <option value=1>Enable</option>
                <option value=2>Disabled</option>
            </select>
        </td>
        <td>
            <select class="form-control rounded-corner" id="Category" id3="<?php echo $row['RateID']  ?>">
                <option value="">Select Category</option>
                <?php 
                $query="SELECT * from cyrusbackend.item order by ItemName";
                $result2=mysqli_query($con,$query);
                while ($arr=mysqli_fetch_assoc($result2))
                {
                    echo "<option value='".$arr['ItemID']."'>".$arr['ItemName']."</option><br>";
                }
                ?>
            </select>
        </td>
    </tr>
    <?php 
    $Sr++;
}
}
}

$rows=!empty($_POST['rows'])?$_POST['rows']:'';
if (!empty($rows))
{
    $Sr=1; 
    $i2=2000;
    $i3=3000;
    while($rows>0){

        print "<tr>";
        print '<td>'.$Sr."</td>";
        print '<td style="min-width:450px"><input type="text" class="form-control rounded-corner" min="0" placeholder="Material Name" id="'.$Sr.'"></td>';
        print '<td><input type="number" class="form-control rounded-corner" min="0" placeholder="Rate" id="'.$i2.'"></td>';           
        ?>
        <td>
            <select class="form-control rounded-corner" id="<?php echo $i3; ?>">
                <option value="">Select Category</option>
                <?php 
                $query="SELECT * from cyrusbackend.item order by ItemName";
                $result2=mysqli_query($con,$query);
                while ($arr=mysqli_fetch_assoc($result2))
                {
                    echo "<option value='".$arr['ItemID']."'>".$arr['ItemName']."</option><br>";
                }
                ?>
            </select>
        </td>
    </tr>
    <?php 
    $Sr++;
    $i2++;
    $i3++;
    $rows--;
}
}

$Description=!empty($_POST['Description'])?$_POST['Description']:'';
if (!empty($Description))
{
    
    $Zone=!empty($_POST['Zone'])?$_POST['Zone']:'';
    $Rate=!empty($_POST['Rate'])?$_POST['Rate']:'';
    $ItemID=!empty($_POST['Catagory'])?$_POST['Catagory']:'';

    for ($i=0; $i < count($Description); $i++) { 
        //echo $Description[$i].'<br>';
        $sql = "INSERT INTO rates (ItemID, Zone, Rate, UpdateON, Description)
        VALUES ($ItemID[$i], $Zone, $Rate[$i], '$Date', '$Description[$i]')";
        if ($con2->query($sql) === TRUE) {
        }else{
            echo "Error: " . $sql . "<br>" . $con2->error;
        }
    }

}

?>