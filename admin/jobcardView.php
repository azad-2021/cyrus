    <table class="table table-hover table-bordered border-primary">
        <thead>
            <th style="min-width:70px;">Sr No</th>
            <th style="min-width:100px;">Jobcard No.</th>
            <th style="min-width:150px;">Bank</th>
            <th style="min-width:150px;">Zone</th>
            <th style="min-width:150px;">Branch</th>
            <th style="min-width:150px;">District</th>
            <th style="min-width:150px;">Gadget</th>
            <th style="min-width:150px;">Employee</th>
            <th style="min-width:150px;">Visit Date</th>
            <th style="min-width:250px;">Service Done</th>
            <th style="min-width:250px;">Pending Work</th>
        </thead>
        <tbody>
            <?php  
            include('connection.php');   
            if(isset($_POST["ID"]))
            {
             $sr=1;
             $query = "SELECT * FROM jobcardmain
             join branchdetails on jobcardmain.BranchCode=branchdetails.BranchCode
             WHERE `Card Number` like '%".$_POST["ID"]."%' order by Job_card_no desc";
             $result = mysqli_query($con, $query);
             $output .= '  
             <div class="table-responsive">  
             <table class="table table-hover table-bordered border-primary">';
             while($row = mysqli_fetch_array($result))
             {

                $GadgetID=$row['GadgetID'];
                $EmployeeID=$row["EmployeeCode"];
                $Employee='';
                $Gadget='';
                if (!empty($EmployeeID))
                {
                    $query="SELECT * FROM employees WHERE EmployeeCode=$EmployeeID";
                    $resultTech=mysqli_query($con,$query);
                    if (mysqli_num_rows($resultTech)>0){
                        $rowE=mysqli_fetch_assoc($resultTech);
                        $Employee=$rowE["Employee Name"];
                    }
                }
                if (!empty($GadgetID))
                {

                    $querygadget="SELECT * FROM gadget WHERE GadgetID=$GadgetID";
                    $resultGadget=mysqli_query($con,$querygadget);
                    if (mysqli_num_rows($resultGadget)>0){
                        $rowG=mysqli_fetch_assoc($resultGadget);
                        $Gadget=$rowG["Gadget"];
                    }
                }


                ?>



                <tr>
                    <td><?php echo $sr; ?></td>
                    <td><?php echo $row["Card Number"]; ?></td>
                    <td><?php echo $row["BankName"]; ?></td>
                    <td><?php echo $row["ZoneRegionName"]; ?></td>
                    <td><?php echo $row["BranchName"]; ?></td>
                    <td><?php echo $row["Address3"]; ?></td>
                    <td><?php echo $Gadget; ?></td>
                    <td><?php echo $Employee; ?></td>
                    <td><?php echo date("d-m-Y", strtotime($row["VisitDate"])); ?></td>
                    <td><?php echo $row["ServiceDone"]; ?></td>
                    <td><?php echo $row["WorkPending"]; ?></td>
                </tr>

                <?php 
                $sr++;
            }
            echo '</tbody></table></div>';
        }
        ?>

