<?php
include ('data.php');
?>
<!DOCTYPE html>
    <html>
        <Head>
            <meta name ="viewport" content="width=device-width,initial-scale=1.0">
        </Head>
        <body>
            <div class="Dropdown">
                <form autocomplete="off" action="">
                    <div class="input-field">
                        <select id="Bank">
                            <option value="">Select Bank</option>
                            <?php
                            $BankData="Select BankCode, BankName from bank";
                            $result=mysqli_query($conn,$BankData);
                            if (mysqli_num_rows($result)>0)
                            {
                                while ($arr=mysqli_fetch_assoc($result))
                                {
                                    ?>
                                    <option value="<?php echo $arr['BankCode']; ?>"><?php echo $arr['BankName']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="input-field">
                        <select id="Zone">
                            <option value="">Zone</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <select id="Branch">
                            <option value="">Branch</option>
                        </select>
                    </div>
                </form>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="ajax-script.js" type="text/javascript">
            </script>
        </body>
    </html>

<?php 
  $con -> close();
  $con2 -> close();
 ?>